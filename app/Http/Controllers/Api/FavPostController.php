<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Post\PostIdRequest;
use App\Models\{Post, FavPost, User};
use App\Http\Resources\Post\{PostResource, HomeResource};
use App\Http\Requests\Api\Profile\{UserIdRequest};

class FavPostController extends Controller
{
    public function store(PostIdRequest $request, $post_id = null)
    {
        $is_fav = false;
        if (FavPost::where(['user_id' => auth('api')->id(), 'post_id' => $request->post_id])->exists()) {
            FavPost::where(['user_id' => auth('api')->id(), 'post_id' => $request->post_id])->delete();
            $is_fav = false;
        } else {
            FavPost::create(['user_id' => auth('api')->id(), 'post_id' => $request->post_id]);
            $is_fav = true;
            // Send Notificaition to Client
            // $data = [
            //     'key' => "new_follow",
            //     'title' => trans('app.notification.title.follow'),
            //     'body' => trans('app.notification.body.follow', ['sender_name' => auth('api')->user()->username]),
            //     'user_id' => auth('api')->id(),
            // ];
            // $data_notification = [
            //     'key' => "new_follow",
            //     'key_id' => auth('api')->id(),
            //     'title' => trans('app.notification.title.follow'),
            //     'body' => trans('app.notification.body.follow', ['sender_name' => auth('api')->user()->username]),
            //     'sender_data' => new UserListResource(auth('api')->user()),
            // ];
            // $user->notify(new GeneralNotification($data_notification));
            // if ($user->devices) {
            //     pushFcmNotes($data, $user->devices);
            // }
        }
        return response(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => ['is_fav' => $is_fav]], 200);
    }

    public function fav_posts(UserIdRequest $request)
    {
        $user = User::find($request->id);
        $posts = $user->fav_posts;
        return HomeResource::collection($posts)->additional(['status' => 'true', 'message' => '', "meta" => [
            "current_page" => $posts->currentPage(),
            "from" => $posts->firstItem(),
            "last_page" => $posts->lastPage(),
            "path" => $posts->url($request->page),
            "per_page" => $posts->perPage(),
            "to" => $posts->lastItem(),
            "total" => $posts->total()
        ]]);
        // return response(['status' => 'true', 'message' => null, 'data' => PostResource::collection($user->fav_posts)], 200);
    }
}
