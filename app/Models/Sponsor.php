<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Sponsor extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public $translatedAttributes = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('logo')) {
                if ($data->image()->exists()) {
                    if (file_exists(storage_path('app/public/uploads/sponsor' . "/" . $data->image->image))) {
                        $image = \App\Http\Controllers\General\ImageController::delete_single_file($data->image->image, 'app/public/uploads/sponsor');
                    }
                    AppImage::where(['app_imageable_type' => 'App\Models\Sponsor', 'app_imageable_id' => $data->id, 'image' => $data->image->image])->delete();
                }
                $image = \App\Http\Controllers\General\ImageController::upload_single_file(request()->logo, 'app/public/uploads/sponsor');
                $data->image()->create(['image' => $image]);
            }
        });
    }

    public function delete()
    {
        if ($this->image()->exists()) {
            if (file_exists(storage_path('app/public/uploads/sponsor' . "/" . $this->image->image))) {
                \App\Http\Controllers\General\ImageController::delete_single_file($this->image->image, 'app/public/uploads/sponsor');
            }
            AppImage::where(['app_imageable_type' => 'App\Models\Sponsor', 'app_imageable_id' => $this->id, 'image' => $this->image->image])->delete();
        }
        parent::delete();
    }

    public function image()
    {
        return $this->morphOne(AppImage::class, 'app_imageable');
    }

    public function getLogoUrlAttribute()
    {
        if ($this->image()->exists()) {
            if (!file_exists(storage_path('app/public/uploads/sponsor' . "/" . $this->image->image))) {
                return asset('storage/uploads/default.png');
            }
            return asset('storage/uploads/sponsor') . '/' . $this->image->image;
        } else {
            return asset('storage/uploads/default.png');
        }
    }
}