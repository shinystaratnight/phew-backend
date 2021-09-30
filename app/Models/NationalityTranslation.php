<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NationalityTranslation extends Model
{
    public $timestamps = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($data) {
            $data->update([
                'slug' => Str::slug($data->name) . '-' . $data->id,
            ]);
        });
    }

    public function setNameAttribute($value)
    {
        if (!isset($this->attributes['name'])) {
            $this->attributes['name'] = $value;
            $this->attributes['slug'] = '';
        } else {
            $this->attributes['name'] = $value;
            $this->attributes['slug'] = Str::slug($value) . '-' . $this->attributes['id'];
        }
    }
}