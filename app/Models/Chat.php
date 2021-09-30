<?php

namespace App\Models;

use App\Http\Controllers\General\ImageController;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['message_value'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function setMessageAttribute($value)
    {
        if ($this->attributes['message_type'] == "image") {
            $filename = generate_code() . '_' . time() . '.' . $value->getClientOriginalExtension();
            $value->move(storage_path('app/public/uploads/chat/image'), $filename);
            $this->attributes['message'] = $filename;
        } else if ($this->attributes['message_type'] == "video") {
            $filename = generate_code() . '_' . time() . '.' . $value->getClientOriginalExtension();
            $value->move(storage_path('app/public/uploads/chat/video'), $filename);
            $this->attributes['message'] = $filename;
        } else if ($this->attributes['message_type'] == "voice_message") {
            $filename = generate_code() . '_' . time() . '.' . $value->getClientOriginalExtension();
            $value->move(storage_path('app/public/uploads/chat/voice_message'), $filename);
            $this->attributes['message'] = $filename;
        } else {
            $this->attributes['message'] = $value;
        }
    }

    public function getMessageValueAttribute()
    {
        if ($this->attributes['message_type'] == "image") {
            if (!file_exists(storage_path('app/public/uploads/chat/image' . "/" . $this->attributes['message']))) {
                return trans('app.chat.deleted_file');
            }
            return asset('storage/uploads/chat/image') . '/' . $this->attributes['message'];
        } else if ($this->attributes['message_type'] == "video") {
            if (!file_exists(storage_path('app/public/uploads/chat/video' . "/" . $this->attributes['message']))) {
                return trans('app.chat.deleted_file');
            }
            return asset('storage/uploads/chat/video') . '/' . $this->attributes['message'];
        } else if ($this->attributes['message_type'] == "voice_message") {
            if (!file_exists(storage_path('app/public/uploads/chat/voice_message' . "/" . $this->attributes['message']))) {
                return trans('app.chat.deleted_file');
            }
            return asset('storage/uploads/chat/voice_message') . '/' . $this->attributes['message'];
        } else {
            return $this->attributes['message'];
        }
    }
}
