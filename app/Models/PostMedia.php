<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $guarded=['id','created_at','updated_at','deleted_at'];

    public function post_mediable()
    {
    	return $this->morphTo();
    }

    public function getDataAttribute()
    {
        if(in_array($this->attributes['media_type'], ['video', 'image'])){
            if (file_exists(storage_path('app/public/uploads/posts' . "/" . $this->attributes['data']))) {
                return asset('storage/uploads/posts') . '/' . $this->attributes['data'];
            } else {
                return asset('storage/uploads/default.png');
            }
        }
        return $this->attributes['data'];
    }

    public function getCoverNameAttribute()
    {
        if($this->attributes['cover_name']){
            if (file_exists(storage_path('app/public/uploads/posts' . "/" . $this->attributes['cover_name']))) {
                return asset('storage/uploads/posts') . '/' . $this->attributes['cover_name'];
            } else {
                return asset('storage/uploads/default.png');
            }
        }else{
            return asset('storage/uploads/default.png');
        }
        return $this->attributes['cover_name'];
    }
}
