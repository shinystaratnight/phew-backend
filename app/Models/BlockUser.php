<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockUser extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blocked_user()
    {
        return $this->belongsTo(User::class, 'blocked_user_id');
    }
}
