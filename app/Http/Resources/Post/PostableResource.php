<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $location = $this->media()->where('media_type', 'location')->first();
        $watching = $this->media()->where('media_type', 'watching')->first();
        $like = auth('api')->check() ? \App\Models\LikePost::where(['user_id' => auth('api')->id(), 'post_id' => $this->id])->first() : null;
        return [
            'id' => $this->id,
            'post_type' => $this->post_type,
            'activity_type' => $this->activity_type,
            'text' => $this->text,
            'show_privacy' => $this->show_privacy,
            'created_at' => date('Y-m-d H:i', strtotime($this->created_at)),
            'created_ago' => $this->created_at->diffforHumans(),
            'is_like' => $like ? true : false,
            'like_type' => $like ? $like->type : null,
            'likes_count' => $this->likes->count(),
            'is_fav' => auth('api')->check() ? is_fav(auth('api')->id(), $this->id) : false,
            'location' => new MediaResource($location),
            'watching' => new MediaResource($watching),
            'images' => MediaResource::collection($this->media->where('media_type', 'image')),
            'videos' => MediaResource::collection($this->media->where('media_type', 'video')),
            'user' => new UserListResource($this->user),
            'mentions' => UserListResource::collection($this->mentions),
            'screen_shots' => auth('api')->check() ? (auth('api')->id() == $this->user_id ? UserListResource::collection($this->users_screen_shot) : []) : [],
            'comments_count' => $this->comments->count(),
        ];
    }
}
