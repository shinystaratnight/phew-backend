<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Country\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
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
            'username' => $this->username,
            'fullname' => $this->fullname,
            'profile_image' => $this->profile_image,
            'is_follow' => auth('api')->check() ? (is_follow(auth('api')->id(), $this->id) ? true : false) : false,
            'is_friend' => auth('api')->check() ? (is_friend(auth('api')->id(), $this->id) ? true : false) : false,
            'city' => $this->city ? new CityResource($this->city) : null,
        ];
    }
}
