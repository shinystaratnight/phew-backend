<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SecretMessage extends Model
{
    protected $guarded = ['id','created_at','updated_at'];
    use SoftDeletes;

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // child post
    public function reply()
    {
        return $this->morphMany(Post::class, 'postable');
    }
}
