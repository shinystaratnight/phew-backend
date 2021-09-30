<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationList extends JsonResource
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
            'title' => app()->getLocale() == 'en' ? $this->data['title']['en'] : $this->data['title']['ar'],
            'body' => app()->getLocale() == 'en' ? $this->data['body']['en'] : $this->data['body']['ar'],
            'created_time' => $this->created_at->diffforHumans(),
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at))
        ] + $this->data;
    }
}
