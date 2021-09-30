<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{City, Country, Nationality};
use App\Http\Resources\Country\{CityResource, CountryResource, NationalityResource};

class CountryController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'true', 'message' => '', 'data' => CountryResource::collection(Country::all())], 200);
    }

    public function nationalities()
    {
        return response()->json(['status' => 'true', 'message' => '', 'data' => NationalityResource::collection(Nationality::all())], 200);
    }

    public function cities($country_id = null)
    {
        if ($country_id == null) {
            return response()->json(['status' => 'false', 'message' => trans('app.country.country_not_found'), 'data' => null], 422);
        }
        return response()->json(['status' => 'true', 'message' => '', 'data' => CityResource::collection(City::where('country_id', $country_id)->get())], 200);
    }
}
