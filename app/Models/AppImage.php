<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppImage extends Model
{
    protected $guarded=['id','created_at','updated_at','deleted_at'];

    public function app_imageable()
    {
    	return $this->morphTo();
    }

    public function getImageUrlAttribute()
    {
        if($this->attributes['app_imageable_type'] == 'App\Models\User'){
            if (file_exists(storage_path('app/public/uploads/user' . "/" . $this->attributes['image']))) {
                return asset('storage/uploads/user') . '/' . $this->attributes['image'];
            } else {
                return asset('storage/uploads/user-default.png');
            }
        }
        return $this->attributes['image'];
    }
}
