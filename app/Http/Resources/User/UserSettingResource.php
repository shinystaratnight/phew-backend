<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSettingResource extends JsonResource
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
            'all_notices' => $this->all_notices,
            'notification_to_new_followers' => $this->notification_to_new_followers,
            'notification_to_mention' => $this->notification_to_mention,
            'delete_inactive_followers_and_friends' => $this->delete_inactive_followers_and_friends,
        ];
    }
}
