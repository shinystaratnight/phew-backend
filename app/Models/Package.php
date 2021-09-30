<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Package extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public $translatedAttributes = ['name', 'slug'];

    public function setPlanAttribute($value)
    {
        if ($value) {
            $this->attributes['plan'] = json_encode($value);
        }
    }

    public function getPlanAttribute($value)
    {
        return json_decode($this->attributes['plan']);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_packages', 'package_id', 'country_id')->withPivot('price');
    }

    public function country_package($country_id)
    {
        return $this->hasMany(CountryPackage::class)->where('country_id', $country_id);
    }

    public function country_packages()
    {
        return $this->hasMany(CountryPackage::class);
    }
}
