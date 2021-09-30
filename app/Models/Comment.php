<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('images')) {
                $images = \App\Http\Controllers\General\ImageController::upload_multi_files(request()->images, 'app/public/uploads/posts');
                data_set($images, '*.media_type', 'image');
                $data->media()->createMany($images);
            }
        });
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function retweet()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function media()
    {
        return $this->morphMany(PostMedia::class, 'post_mediable');
    }
}
