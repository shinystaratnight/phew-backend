<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Role extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    public $translatedAttributes = ['name','desc'];

    public function setPlanAttribute($value)
    {
        if ($value != '*') {
            $this->attributes['plan'] = json_encode($value);
        }
    }

    public function getPlanAttribute()
    {
        if ($this->attributes['plan'] != '*') {
            return json_decode($this->attributes['plan']);
        } else {
            return $this->attributes['plan'];
        }
    }
}
