<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Nationality extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id','created_at','updated_at','deleted_at'];
    public $translatedAttributes = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('flag')) {
                if ($data->image()->exists()) {
                    $image = \App\Http\Controllers\General\ImageController::delete_single_file($data->image->image, 'app/public/uploads/nationality');
                    AppImage::where(['app_imageable_type' => 'App\Models\Nationality', 'app_imageable_id' => $data->id, 'image' => $data->image->image])->delete();
                }
                $image = \App\Http\Controllers\General\ImageController::upload_single_file(request()->flag, 'app/public/uploads/nationality');
                $data->image()->create(['image' => $image]);
            }
        });
    }

    public function delete()
    {
        if ($this->image()->exists()) {
            if (file_exists(storage_path('app/public/uploads/nationality' . "/" . $this->image->image))) {
                \App\Http\Controllers\General\ImageController::delete_single_file($this->image->image, 'app/public/uploads/nationality');
            }
            AppImage::where(['app_imageable_type' => 'App\Models\Nationality', 'app_imageable_id' => $this->id, 'image' => $this->image->image])->delete();
        }
        parent::delete();
    }

    public function image()
    {
        return $this->morphOne(AppImage::class, 'app_imageable');
    }

    public function getFlagUrlAttribute()
    {
        if ($this->image()->exists()) {
            if (!file_exists(storage_path('app/public/uploads/nationality' . "/" . $this->image->image))) {
                return asset('storage/uploads/default.png');
            }
            return asset('storage/uploads/nationality') . '/' . $this->image->image;
        } else {
            return asset('storage/uploads/default.png');
        }
    }
}
