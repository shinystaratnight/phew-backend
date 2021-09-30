<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
            if (request()->hasFile('videos')) {
                $videos = \App\Http\Controllers\General\ImageController::upload_multi_videos(request()->videos, 'app/public/uploads/posts');
                data_set($videos, '*.media_type', 'video');
                $data->media()->createMany($videos);
            }
            if (request()->location) {
                $data->media()->create(['media_type' => 'location', 'data' => request()->location]);
            }
            if (request()->watching) {
                $data->media()->create(['media_type' => 'watching', 'data' => request()->watching]);
            }
        });
    }

    // parent post
    public function postable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // child post
    public function retweet()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function findly()
    {
        return $this->hasMany(FindlyPost::class);
    }

    public function likes()
    {
        return $this->hasMany(LikePost::class);
    }

    public function favs()
    {
        return $this->hasMany(FavPost::class);
    }

    public function media()
    {
        return $this->morphMany(PostMedia::class, 'post_mediable');
    }

    public function mentions()
    {
        return $this->belongsToMany(User::class, 'mention_posts', 'post_id', 'user_id')->withTimestamps();
    }

    public function users_screen_shot()
    {
        return $this->belongsToMany(User::class, 'screen_shot_posts', 'post_id', 'user_id')->withTimestamps();
    }

    public function screen_shots()
    {
        return $this->hasMany(ScreenShotPost::class);
    }

    public function delete()
    {
        $files = $this->media()->whereIn('media_type', ['image', 'video'])->get();
        foreach($files as $file){
            if (file_exists(storage_path('app/public/uploads/posts' . "/" . $file->data))) {
                \App\Http\Controllers\General\ImageController::delete_single_file($file->data, 'app/public/uploads/posts');
            }
            $file->delete();
        }
        parent::delete();
    }

    public function getImageListAttribute()
    {
        $images_path = [];
        $images = $this->media()->where('media_type', 'image')->pluck('data')->toArray();
        foreach ($images as $image) {
            if (file_exists(storage_path('app/public/uploads/posts' . "/" . $image))) {
                $image_url = asset('storage/uploads/posts') . '/' . $image;
            } else {
                $image_url = asset('storage/uploads/default.png');
            }
            $images_path[] = $image_url;
        }
        return $images_path;
    }

    public function getVideoListAttribute()
    {
        $videos_path = [];
        $videos = $this->media()->where('media_type', 'video')->pluck('data')->toArray();
        foreach ($videos as $video) {
            if (file_exists(storage_path('app/public/uploads/posts' . "/" . $video))) {
                $video_url = asset('storage/uploads/posts') . '/' . $video;
            } else {
                $video_url = asset('storage/uploads/default.png');
            }
            $videos_path[] = $video_url;
        }
        return $videos_path;
    }
}
