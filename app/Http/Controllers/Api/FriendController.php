<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\{UserIdRequest};
use App\Http\Resources\User\FriendListResource;
use App\Models\{FriendUser, User};
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index(Request $request)
    {
        $friends = FriendUser::where(function ($query) {
            $query->where(['user_id' => auth('api')->id()]);
            $query->orWhere(['friend_id' => auth('api')->id()]);
        })->get();
        return response(['status' => 'true', 'message' => null, 'data' => FriendListResource::collection($friends)], 200);
    }

    public function remove(UserIdRequest $request)
    {
        if (auth('api')->id() == $request->id) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 401);
        }
        $user = User::find($request->id);

        $friend = FriendUser::where(function ($query) {
            $query->where(['user_id' => auth('api')->id()]);
            $query->orWhere(['friend_id' => auth('api')->id()]);
        })->where(function ($query) use ($request) {
            $query->where(['user_id' => $request->id]);
            $query->orWhere(['friend_id' => $request->id]);
        })->first();
        if (!$friend) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 401);
        }

        $friend->delete();
        return response(['status' => 'true', 'message' => trans('app.messages.deleted_successfully'), 'data' => null], 200);
    }
}
