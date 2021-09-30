<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\{UserIdRequest};
use App\Http\Resources\User\{UserListResource};
use App\Models\{FollowUser, User};
use App\Notifications\Api\ApiNotification;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(UserIdRequest $request)
    {
        if (auth('api')->id() == $request->id) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_modify'), 'data' => null], 401);
        }
        $user = User::find($request->id);
        $is_follow = true;
        if (FollowUser::where(['from_user_id' => auth('api')->id(), 'to_user_id' => $user->id])->exists()) {
            FollowUser::where(['from_user_id' => auth('api')->id(), 'to_user_id' => $user->id])->delete();
            $is_follow = false;
        } else {
            FollowUser::create(['from_user_id' => auth('api')->id(), 'to_user_id' => $user->id]);
            $is_follow = true;

            $data = [
                'key' => "follow",
                'key_type' => "user",
                'key_id' => $user->id,
                'title' => [
                        'ar' => trans('app.notification.title.follow', [], 'ar'),
                        'en' => trans('app.notification.title.follow', [], 'en'),
                    ],
                'body' => [
                    'ar' => trans('app.notification.body.follow', ['sender_name' => auth('api')->user()->fullname], 'ar'),
                    'en' => trans('app.notification.body.follow', ['sender_name' => auth('api')->user()->fullname], 'en'),
                ],
                'sender_data' => new UserListResource(auth('api')->user()),
            ];
            $user->notify(new ApiNotification($data, ['database', 'fcm']));
        }
        return response(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => ['is_follow' => $is_follow]], 200);
    }

    public function followings(UserIdRequest $request)
    {
        $user = User::find($request->id);
        return response(['status' => 'true', 'message' => null, 'data' => UserListResource::collection($user->followings)], 200);
    }

    public function followers(UserIdRequest $request)
    {
        $user = User::find($request->id);
        return response(['status' => 'true', 'message' => null, 'data' => UserListResource::collection($user->followers)], 200);
    }
}
