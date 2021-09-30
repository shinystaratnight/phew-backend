<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Post\PostIdRequest;
use App\Http\Resources\User\{UserListResource};
use App\Models\{Post, LikePost, User};
use App\Notifications\Api\ApiNotification;
use App\Http\Resources\Post\{PostResource, HomeResource};
use App\Http\Requests\Api\Profile\{UserIdRequest};

class LikePostController extends Controller
{
    public function store(PostIdRequest $request, $post_id = null)
    {
        $is_like = false;
        $post = Post::findOrFail($request->post_id);
        if (isset($request->type)) {
            LikePost::updateOrCreate(['user_id' => auth('api')->id(), 'post_id' => $request->post_id], ['type' => $request->type]);
            $is_like = true;
            
            if(auth('api')->id() != $post->user_id){
                $data = [
                    'key' => "like",
                    'key_type' => "post",
                    'key_id' => $post->id,
                    'title' => [
                            'ar' => trans('app.notification.title.like', [], 'ar'),
                            'en' => trans('app.notification.title.like', [], 'en'),
                        ],
                    'body' => [
                        'ar' => trans('app.notification.body.like', ['sender_name' => auth('api')->user()->fullname], 'ar'),
                        'en' => trans('app.notification.body.like', ['sender_name' => auth('api')->user()->fullname], 'en'),
                    ],
                    'sender_data' => new UserListResource(auth('api')->user()),
                ];
                $post->user->notify(new ApiNotification($data, ['database', 'fcm']));
            }

        } else {
            LikePost::where(['user_id' => auth('api')->id(), 'post_id' => $request->post_id])->delete();
            $is_like = false;
        }
        return response(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => ['is_like' => $is_like, 'type' => isset($request->type) ? $request->type : null]], 200);
    }

    public function like_posts(UserIdRequest $request)
    {
        $user = User::find($request->id);
        $posts = $user->like_posts;
        return HomeResource::collection($posts)->additional(['status' => 'true', 'message' => '', "meta" => [
            "current_page" => $posts->currentPage(),
            "from" => $posts->firstItem(),
            "last_page" => $posts->lastPage(),
            "path" => $posts->url($request->page),
            "per_page" => $posts->perPage(),
            "to" => $posts->lastItem(),
            "total" => $posts->total()
        ]]);
        // return response(['status' => 'true', 'message' => null, 'data' => PostResource::collection($user->like_posts)], 200);
    }
}
