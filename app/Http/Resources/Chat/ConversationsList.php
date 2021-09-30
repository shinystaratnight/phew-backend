<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\User\UserListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationsList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $last_message = $this->last_message;
        if ($this->message_type == 'video' || $this->message_type == 'image' || $this->message_type == 'voice_message') {
            $last_message = trans('app.chat.file_attached');
        } else if ($this->message_type == 'location') {
            $last_message = trans('app.chat.coordinates_were_sent');
        }
        $other_user_data = null;
        if ($this->sender_id == auth('api')->id()) {
            $other_user_data = $this->receiver;
        } else {
            $other_user_data = $this->sender;
        }
        return [
            'id' => $this->id,
            'message_type' => $this->message_type,
            'last_message' => $last_message,
            'sender_data' => $this->sender ? new UserListResource($this->sender) : null,
            'receiver_data' => $this->receiver ? new UserListResource($this->receiver) : null,
            'other_user_data' => $other_user_data ? new UserListResource($other_user_data) : null,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'ago_time' => $this->created_at->diffforhumans(),
        ];
    }
}
