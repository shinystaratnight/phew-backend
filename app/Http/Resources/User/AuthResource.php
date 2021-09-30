<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Country\{CityResource, NationalityResource};
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'mobile' => $this->mobile,
            'email' => $this->email,
            'gender' => $this->gender ?? null,
            'date_of_birth' => $this->date_of_birth ? \Carbon\Carbon::parse($this->date_of_birth)->format('Y-m-d') : null,
            'profile_image' => $this->profile_image,
            'profile_images' => ImageResource::collection($this->image),
            'cover' => $this->cover_url,
            'is_verified' => false,
            'is_follow' => auth('api')->check() ? (is_follow(auth('api')->id(), $this->id) ? true : false) : false,
            'follower_count' => $this->followers->count(),
            'following_count' => $this->followings->count(),
            'is_friend' => auth('api')->check() ? (is_friend(auth('api')->id(), $this->id) ? true : false) : false,
            'is_friend_request' => false,
            'sender_friend_request' => null,
            'friends_count' => $this->friends->count(),
            'posts_count' => $this->posts->count(),
            'is_subscribed' => subscribe_data($this),
            'subscribe_data' => subscribe_data($this) ? new UserPackageResource($this->package_user()->latest()->first()) : null,
            'user_settings' => new UserSettingResource($this->user_setting),
            'token' => ['token_type' => 'Bearer', 'access_token' => $this->auth_token],
            'city' => $this->city_id == null ? null : new CityResource($this->city),
            'nationality' => $this->nationality_id == null ? null : new NationalityResource($this->nationality),
            'lat'=>$this->lat,
            'lng'=>$this->lng,
        ];
    }
}
