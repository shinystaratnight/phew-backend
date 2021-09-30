<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class FriendRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = auth('api')->id() == $this->from_user->id ? $this->to_user : $this->from_user;
        return [
            'user' => new UserListResource($user),
            'date' => $this->created_at->diffforHumans(),
        ];
    }
}
