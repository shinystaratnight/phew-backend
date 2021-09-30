<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Scopes\RoleScope;

class Country extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public $translatedAttributes = ['name', 'currency'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
            if (request()->hasFile('flag')) {
                if ($data->image()->exists()) {
                    $image = \App\Http\Controllers\General\ImageController::delete_single_file($data->image->image, 'app/public/uploads/country');
                    AppImage::where(['option' => 'flag', 'app_imageable_type' => 'App\Models\Country', 'app_imageable_id' => $data->id, 'image' => $data->image->image])->delete();
                }
                $image = \App\Http\Controllers\General\ImageController::upload_single_file(request()->flag, 'app/public/uploads/country');
                $data->image()->create(['image' => $image, 'option' => 'flag']);
            }
        });
    }

    public function delete()
    {
        if ($this->image()->exists()) {
            if (file_exists(storage_path('app/public/uploads/country' . "/" . $this->image->image))) {
                \App\Http\Controllers\General\ImageController::delete_single_file($this->image->image, 'app/public/uploads/country');
            }
            AppImage::where(['app_imageable_type' => 'App\Models\Country', 'app_imageable_id' => $this->id, 'image' => $this->image->image])->delete();
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
            if (!file_exists(storage_path('app/public/uploads/country' . "/" . $this->image->image))) {
                return asset('storage/uploads/default.png');
            }
            return asset('storage/uploads/country') . '/' . $this->image->image;
        } else {
            return asset('storage/uploads/default.png');
        }
    }
}
