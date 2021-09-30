<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class City extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public $translatedAttributes = ['name'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasManyThrough(LikePost::class, Post::class, 'city_id', 'post_id');
    }

    public function scopeNearest($query, $lat, $lng)
    {
        $lat = (float) $lat;
        $lng = (float) $lng;
        $query->select(\DB::raw("*,
                (6378.10 * ACOS(COS(RADIANS($lat))
                * COS(RADIANS(lat))
                * COS(RADIANS($lng) - RADIANS(lng))
                + SIN(RADIANS($lat))
                * SIN(RADIANS(lat)))) AS distance"))
            ->orderBy('distance', 'asc');
    }
}
