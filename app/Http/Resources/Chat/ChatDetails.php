<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\User\UserListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatDetails extends JsonResource
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
            'conversation_id' => $this->conversation_id,
            'message_type' => $this->message_type,
            'message' => $this->message_value,
            'message_position' => $this->sender_id == auth('api')->id() ? 'current' : 'other',
            'sender_data' => $this->sender ? new UserListResource($this->sender) : null,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'ago_time' => $this->created_at->diffforhumans(),
        ];
    }
}
