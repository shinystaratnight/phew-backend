<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function getMovieDetailAttribute()
    {
        return json_decode($this->attributes['movie_data']);
    }
}
