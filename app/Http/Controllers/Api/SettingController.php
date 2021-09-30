<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Setting\MovieResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function about()
    {
        return response()->json(['status' => 'true', 'message' => '', 'data' => ['about' => settings('about_' . app()->getLocale())]], 200);
    }

    public function conditions_terms()
    {
        return response()->json(['status' => 'true', 'message' => '', 'data' => ['conditions_terms' => settings('conditions_terms_' . app()->getLocale())]], 200);
    }

    public function social_info()
    {
        $settings = [
            'email' => settings('email'),
            'mobile' => settings('mobile'),
            'facebook_url' => settings('facebook_url'),
            'twitter_url' => settings('twitter_url'),
            'youtube_url' => settings('youtube_url'),
            'instagram_url' => settings('instagram_url'),
            'whatsapp_phone' => settings('whatsapp_phone'),
        ];
        return response()->json(['status' => 'true', 'message' => '', 'data' => $settings], 200);
    }

    public function movies(Request $request)
    {
        $movies = \App\Models\Movie::latest('counter')->take(20)->get();
        return response()->json(['status' => 'true', 'message' => '', 'data' => MovieResource::collection($movies)]);
    }
}
