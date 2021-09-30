<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'images' => MediaResource::collection($this->media->where('media_type', 'image')),
            'user' => new UserListResource($this->user),
            'postable' => new PostableResource($this->postable),
        ];
    }
}
