<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppFile extends Model
{
    protected $guarded=['id','created_at','updated_at','deleted_at'];

    
    public function app_fileable()
    {
    	return $this->morphTo();
    }
}
