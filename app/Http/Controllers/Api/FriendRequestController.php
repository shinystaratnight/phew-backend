<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\{UserIdRequest};
use App\Http\Resources\User\{FriendRequestResource, UserListResource};
use App\Models\{FriendRequest, FriendUser, User};
use App\Notifications\Api\ApiNotification;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    public function index(Request $request)
    {
        // filter values => me - friends
        if ($request->filter == 'me') {
            $friends_request = FriendRequest::where('from_user_id', auth('api')->id())->get();
            // $friends_request = auth('api')->user()->my_friend_requests;
        } else {
            $friends_request = FriendRequest::where('to_user_id', auth('api')->id())->get();
            // $friends_request = auth('api')->user()->other_friend_requests;
        }
        return response(['status' => 'true', 'message' => null, 'data' => FriendRequestResource::collection($friends_request)], 200);
    }

    public function send(UserIdRequest $request)
    {
        \DB::beginTransaction();
        try {
            if (auth('api')->id() == $request->id) {
                return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_send'), 'data' => null], 401);
            }
            $user = User::find($request->id);
            if (FriendRequest::where(['from_user_id' => auth('api')->id(), 'to_user_id' => $user->id])->exists()) {
                return response(['status' => 'false', 'message' => trans('app.messages.has_already_been_submitted'), 'data' => null], 401);
            }
            $friend = FriendUser::where(function ($query) {
                $query->where(['user_id' => auth('api')->id()]);
                $query->orWhere(['friend_id' => auth('api')->id()]);
            })->where(function ($query) use ($request) {
                $query->where(['user_id' => $request->id]);
                $query->orWhere(['friend_id' => $request->id]);
            })->first();
            if ($friend) {
                return response(['status' => 'false', 'message' => trans('app.messages.has_already_been_submitted'), 'data' => null], 401);
            }
            FriendRequest::create(['from_user_id' => auth('api')->id(), 'to_user_id' => $user->id]);
            
            $data = [
                'key' => "new_friend_request",
                'key_type' => "user",
                'key_id' => $user->id,
                'title' => [
                        'ar' => trans('app.notification.title.new_friend_request', [], 'ar'),
                        'en' => trans('app.notification.title.new_friend_request', [], 'en'),
                    ],
                'body' => [
                    'ar' => trans('app.notification.body.new_friend_request', ['sender_name' => auth('api')->user()->fullname], 'ar'),
                    'en' => trans('app.notification.body.new_friend_request', ['sender_name' => auth('api')->user()->fullname], 'en'),
                ],
                'sender_data' => new UserListResource(auth('api')->user()),
            ];
            $user->notify(new ApiNotification($data, ['database', 'fcm']));

            // $online_users = online_users();
            // dd($online_users->contains('id', $user->id));
            // if (true) {
            //     $user->notify(new GeneralNotification($data_notification));
            // } else {
            // if ($user->devices) {
            //     pushFcmNotes($data_notification, $user->devices);
            // }
            // }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response(['status' => 'true', 'message' => trans('app.messages.sent_successfully'), 'data' => null], 200);
    }

    public function cancel(UserIdRequest $request)
    {
        if (auth('api')->id() == $request->id) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 401);
        }
        $user = User::find($request->id);

        if (!FriendRequest::where(['from_user_id' => auth('api')->id(), 'to_user_id' => $user->id])->exists()) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 401);
        }

        FriendRequest::where(['from_user_id' => auth('api')->id(), 'to_user_id' => $user->id])->delete();
        return response(['status' => 'true', 'message' => trans('app.messages.deleted_successfully'), 'data' => null], 200);
    }

    public function accept(UserIdRequest $request)
    {
        if (auth('api')->id() == $request->id) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_send'), 'data' => null], 401);
        }
        $user = User::find($request->id);
        if (!FriendRequest::where(['to_user_id' => auth('api')->id(), 'from_user_id' => $user->id])->exists()) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_send'), 'data' => null], 401);
        }
        FriendUser::create(['user_id' => auth('api')->id(), 'friend_id' => $user->id]);
        FriendRequest::where(['to_user_id' => auth('api')->id(), 'from_user_id' => $user->id])->delete();

        $data = [
            'key' => "accept_friend_request",
            'key_type' => "user",
            'key_id' => $user->id,
            'title' => [
                    'ar' => trans('app.notification.title.accept_friend_request', [], 'ar'),
                    'en' => trans('app.notification.title.accept_friend_request', [], 'en'),
                ],
            'body' => [
                'ar' => trans('app.notification.body.accept_friend_request', ['sender_name' => auth('api')->user()->fullname], 'ar'),
                'en' => trans('app.notification.body.accept_friend_request', ['sender_name' => auth('api')->user()->fullname], 'en'),
            ],
            'sender_data' => new UserListResource(auth('api')->user()),
        ];
        $user->notify(new ApiNotification($data, ['database', 'fcm']));

        return response(['status' => 'true', 'message' => trans('app.messages.added_successfully'), 'data' => null], 200);
    }

    public function reject(UserIdRequest $request)
    {
        if (auth('api')->id() == $request->id) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 401);
        }
        $user = User::find($request->id);

        if (!FriendRequest::where(['to_user_id' => auth('api')->id(), 'from_user_id' => $user->id])->exists()) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 401);
        }

        FriendRequest::where(['to_user_id' => auth('api')->id(), 'from_user_id' => $user->id])->delete();
        return response(['status' => 'true', 'message' => trans('app.messages.deleted_successfully'), 'data' => null], 200);
    }
}
