<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdSponsor extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('file')) {
                if ($data->image()->exists()) {
                    \App\Http\Controllers\General\ImageController::delete_single_file($data->image->image, 'app/public/uploads/ad_sponsor');
                    AppImage::where(['app_imageable_type' => 'App\Models\AdSponsor', 'app_imageable_id' => $data->id, 'image' => $data->image->image])->delete();
                }
                if(request()->file_type == 'video'){
                    $video = \App\Http\Controllers\General\ImageController::upload_single_video(request()->file, 'app/public/uploads/ad_sponsor', 'storage/uploads/ad_sponsor', 'image');
                    $data->image()->create($video + ['option' => request()->file_type]);
                }else{
                    $image = \App\Http\Controllers\General\ImageController::upload_single_file(request()->file, 'app/public/uploads/ad_sponsor');
                    $data->image()->create(['image' => $image, 'option' => request()->file_type]);
                }
            }
        });
    }

    public function delete()
    {
        if ($this->image()->exists()) {
            if (file_exists(storage_path('app/public/uploads/ad_sponsor' . "/" . $this->image->image))) {
                \App\Http\Controllers\General\ImageController::delete_single_file($this->image->image, 'app/public/uploads/ad_sponsor');
            }
            AppImage::where(['app_imageable_type' => 'App\Models\AdSponsor', 'app_imageable_id' => $this->id, 'image' => $this->image->image])->delete();
        }
        parent::delete();
    }

    public function image()
    {
        return $this->morphOne(AppImage::class, 'app_imageable');
    }

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }

    public function hidden_ad()
    {
        return $this->hasMany(HiddenAd::class);
    }

    public function getFileUrlAttribute()
    {
        if ($this->image()->exists()) {
            if (!file_exists(storage_path('app/public/uploads/ad_sponsor' . "/" . $this->image->image))) {
                return asset('storage/uploads/default.png');
            }
            return asset('storage/uploads/ad_sponsor') . '/' . $this->image->image;
        } else {
            return asset('storage/uploads/default.png');
        }
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->image()->exists()) {
            if (!file_exists(storage_path('app/public/uploads/ad_sponsor' . "/" . $this->image->cover_name))) {
                return asset('storage/uploads/default.png');
            }
            return asset('storage/uploads/ad_sponsor') . '/' . $this->image->cover_name;
        } else {
            return asset('storage/uploads/default.png');
        }
    }
}
