<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Country\{CityResource, NationalityResource};
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $friend_request = null;
        if(auth('api')->check()){
            $friend_request = \App\Models\FriendRequest::where(function ($query) {
                $query->where(['from_user_id' => auth('api')->id()]);
                $query->orWhere(['to_user_id' => auth('api')->id()]);
            })->where(function ($query) use ($request) {
                $query->where(['from_user_id' => $this->id]);
                $query->orWhere(['to_user_id' => $this->id]);
            })->first();
        }
        return [
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth ? \Carbon\Carbon::parse($this->date_of_birth)->format('Y-m-d') : null,
            'profile_image' => $this->profile_image,
            'profile_images' => ImageResource::collection($this->image),
            'cover' => $this->cover_url,
            'is_verified' => false,
            'is_follow' => auth('api')->check() ? (is_follow(auth('api')->id(), $this->id) ? true : false) : false,
            'follower_count' => $this->followers->count(),
            'following_count' => $this->followings->count(),
            'is_friend' => auth('api')->check() ? (is_friend(auth('api')->id(), $this->id) ? true : false) : false,
            'is_friend_request' => $friend_request ? true : false,
            'sender_friend_request' => $friend_request ? ($friend_request->from_user_id == $this->id ? 'other' : 'me') : null,
            'friends_count' => $this->friends->count(),
            'posts_count' => $this->posts->count(),
            'is_subscribed' => subscribe_data($this),
            'subscribe_data' => subscribe_data($this) ? new UserPackageResource($this->package_user()->latest()->first()) : null,
            'user_settings' => new UserSettingResource($this->user_setting),
            'city' => $this->city_id == null ? null : new CityResource($this->city),
            'nationality' => $this->nationality_id == null ? null : new NationalityResource($this->nationality),
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
