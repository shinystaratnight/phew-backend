<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiddenAd extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ad()
    {
        return $this->belongsTo(AdSponsor::class, 'ad_sponsor_id');
    }
}
