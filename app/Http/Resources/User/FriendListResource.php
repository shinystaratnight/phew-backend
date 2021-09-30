<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class FriendListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $friend = auth('api')->id() == $this->user_id ? $this->friend : $this->user;
        return [
            'user' => new UserListResource($friend),
            'date' => $this->created_at->diffforHumans(),
        ];
    }
}
