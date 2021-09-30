<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SocialLoginRequest;
use App\Http\Resources\User\AuthResource;
use App\Models\{User};
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function login(SocialLoginRequest $request)
    {
        $user = User::whereHas('user_social', function ($query) use ($request) {
            $query->where(['provider_type' => $request->provider_type, 'provider_id' => $request->provider_id]);
        })->first();
        if(!$user){
            $user = User::create(['fullname' => $request->fullname, 'is_active' => true]);
            $user->update(['username' => 'user' . $user->id]);
            $user->user_social()->create(array_except($request->validated(), ['fullname', 'device_type', 'device_token']));
        }
        if ($request->device_type && $request->device_token) {
            $user->devices()->firstOrCreate($request->only(['device_type', 'device_token']));
        }
        $token = \JWTAuth::fromUser($user);
        $user->fill(['auth_token' => $token]);
        return response()->json(['status' => 'true', 'message' => trans('app.messages.success_login'), 'data' => new AuthResource($user)]);
    }
}
