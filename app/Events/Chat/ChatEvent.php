<?php

namespace App\Events\Chat;

use App\Http\Resources\User\UserListResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = [
            new PrivateChannel('phew-chat.' . $this->data->chat_id),
            new PrivateChannel('phew-notification.' . $this->data->receiver_id)
        ];
        return $channels;
    }


    public function broadcastWith()
    {
        return [
            'id' => $this->data->id,
            'sender_data' => new UserListResource($this->data->sender),
            'receiver_data' => new UserListResource($this->data->receiver),
            'message_type' => $this->data->message_type,
            'message' => $this->data->last_message,
            'message_position' => $this->data->sender_id == auth('api')->id() ? 'current' : 'other',
            'created_at' => $this->data->created_at->format('Y-m-d H:i'),
            'ago_time' => $this->data->created_at->diffforhumans(),
            
            // notification keys
            'key' => '',
            'title' => '',
            'body' => '',
        ];
    }
}
