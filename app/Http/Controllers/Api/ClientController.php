<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\{PostResource, HomeResource};
use App\Http\Requests\Api\Auth\{
    ChangeRequest,
    LoginRequest,
    LogoutRequest,
    RegisterRequest,
    ResendCodeRequest,
    VerifyRequest
};
use App\Http\Requests\Api\Profile\{UpdatePackageSetting, UpdatePassword, UpdateProfile, UpdateSetting};
use App\Http\Resources\User\{AuthResource, UserResource};
use App\Models\{BlockUser, Device, Package, User, PackageUser};
use App\Notifications\Auth\RegisterNotification;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private function getCredentials(Request $request)
    {
        $identifier = $request->identifier;
        $credentials = [];
        switch ($identifier) {
            case filter_var($identifier, FILTER_VALIDATE_EMAIL):
                $identifier = 'email';
                break;
            case is_numeric($identifier):
                $identifier = 'mobile';
                break;
            default:
                $identifier = 'email';
                break;
        }
        $credentials[$identifier]   = $request->identifier;
        $credentials['password']  = $request->password;
        return $credentials;
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth('api')->attempt($this->getCredentials($request))) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.failed_login'), 'data' => null], 401);
        }
        $user = auth('api')->user();
        if ($user->is_active == false)
            return response()->json(['status' => 'false', 'message' => trans('app.messages.deactivation_message'), 'data' => null, 'is_active' => false, 'identifier' => $request->identifier], 403);
        if ($user->is_banned == true)
            return response()->json(['status' => 'false', 'message' => trans('app.messages.banned_message') . ' : ' . $user->ban_reason, 'data' => null], 401);
        if ($request->device_type && $request->device_token) {
            $user->devices()->firstOrCreate($request->only(['device_type', 'device_token']));
        }
        if ($user->username == null) {
            $user->update(['username' => 'user' . $user->id, 'last_seen_at' => now()]);
        }
        $user->fill(['auth_token' => $token]);
        return response()->json(['status' => 'true', 'message' => trans('app.messages.success_login'), 'data' => new AuthResource($user)]);
    }

    public function register(RegisterRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user = User::create(array_except($request->validated(), ['avatar', 'cover', 'device_type', 'device_token']) + ['last_seen_at' => now(), 'code' => generate_code()]);
            $user->user_setting()->create();

            $package = Package::where('package_type', 'free')->first();
            if ($package) {
                $user_package = PackageUser::create([
                    'user_id' => $user->id,
                    'package_id' => $package->id,
                    'package_type' => $package->package_type,
                    'subscription_start_date' => now(),
                    'subscription_end_date' => now()->add($package->period, $package->period_type),
                    'information' => json_encode($package),
                ]);
            }

            // $user->notify(new RegisterNotification(['mail']));
            if ($request->device_type && $request->device_token) {
                $user->devices()->firstOrCreate($request->only(['device_type', 'device_token']));
            }
            // SMS Code

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => trans('app.messages.success_register'), 'data' => null], 200);
    }

    public function verify(VerifyRequest $request)
    {
        \DB::beginTransaction();
        try {
            $user = User::whereMobile($request->mobile)->first();
            if ($user->is_active && $user->email_verified_at) {
                return response()->json(['status' => 'false', 'message' => trans('app.messages.you_are_already_active'), 'data' => null], 401);
            }
            if ($request->code !=  $user->code) {
                return response()->json(['status' => 'false', 'message' => trans('app.messages.wrong_code_please_try_again'), 'data' => null], 401);
            }
            $user->update(['username' => 'user' . $user->id, 'is_active' => true, 'code' => null, 'email_verified_at' => $user->email_verified_at ?? now()]);
            if ($request->device_type && $request->device_token) {
                $user->devices()->firstOrCreate($request->only(['device_type', 'device_token']));
            }
            $token = \JWTAuth::fromUser($user);
            $user->fill(['auth_token' => $token]);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => trans('app.messages.activated_successfully'), 'data' => new AuthResource($user)], 200);
    }

    public function resend_code(ResendCodeRequest $request)
    {
        try {
            $user = User::whereMobile($request->mobile)->first();
            // $user->notify(new RegisterNotification(['mail']));
            // SMS Code
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => trans('app.messages.sent_code_successfully'), 'data' => null], 200);
    }

    public function forgot_password(ResendCodeRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        try {
            $user->update(['code' => generate_code()]);
            // $user->notify(new RegisterNotification(['mail']));
            // SMS Code

            return response()->json(['status' => 'true', 'message' => trans('app.messages.sent_code_successfully'), 'data' => null, 'code' => $user->code], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 422);
        }
    }

    public function reset_password(ChangeRequest $request)
    {
        $user = User::where(['mobile' => $request->mobile, 'code' => $request->code])->first();
        if (!$user) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.failed_data'), 'data' => null]);
        }
        $user->update(['password' => $request->password, 'code' => null]);
        return response()->json(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => null], 200);
    }

    public function logout(LogoutRequest $request)
    {
        if (auth('api')->check()) {
            $device = Device::where(['user_id' => auth('api')->id(), 'device_type' => $request->device_type, 'device_token' => $request->device_token])->first();
            if ($device) {
                $device->delete();
            }
            // auth('api')->logout();
            return response()->json(['status' => 'true', 'message' => trans('app.messages.success_logout'), 'data' => null]);
        }
    }

    public function profile(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if ($user_id == null || !$user) {
            return response()->json(['status' => 'false', 'message' => trans('app.auth.user_not_found'), 'data' => null], 404);
        }
        if (auth('api')->id() == $user->id) {
            $token = \JWTAuth::fromUser($user);
            $user->fill(['auth_token' => $token]);
            return response()->json(['status' => 'true', 'message' => '', 'data' => new AuthResource($user)]);
        }
        return response()->json(['status' => 'true', 'message' => '', 'data' => new UserResource($user)]);
    }

    public function delete_image(Request $request, $image_id)
    {
        $image = auth('api')->user()->image()->where('option', NULL)->findOrFail($image_id);
        $image->delete();
        return response(['status' => 'true', 'message' => trans('app.messages.deleted_successfully'), 'data' => null], 200);
    }

    public function update_profile(UpdateProfile $request)
    {
        $user = auth('api')->user();
        $user->update(array_except($request->validated(), ['avatar']));
        $user = User::find($user->id);
        $token = \JWTAuth::fromUser($user);
        $user->fill(['auth_token' => $token]);
        return response()->json(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => new AuthResource($user)]);
    }

    public function update_setting(UpdateSetting $request)
    {
        $user = auth('api')->user();
        $user->user_setting()->updateOrCreate(['user_id' => $user->id], $request->validated());
        $token = \JWTAuth::fromUser($user);
        $user->fill(['auth_token' => $token]);
        return response()->json(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => new AuthResource($user)]);
    }

    public function update_package_setting(UpdatePackageSetting $request)
    {
        $user = auth('api')->user();
        $user->user_setting()->updateOrCreate(['user_id' => $user->id], $request->validated());
        $token = \JWTAuth::fromUser($user);
        $user->fill(['auth_token' => $token]);
        return response()->json(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => new AuthResource($user)]);
    }

    public function update_password(UpdatePassword $request)
    {
        if (\Hash::check($request->old_password, auth('api')->user()->password)) {
            $driver = User::find(auth('api')->user()->id);
            $driver->update(['password' => $request->password]);
            return response(['status' => 'true', 'message' => trans('app.messages.updated_successfully'), 'data' => null], 200);
        } else {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.password_not_match'), 'data' => null], 401);
        }
    }

    public function block(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if ($user_id == null || !$user) {
            return response()->json(['status' => 'false', 'message' => trans('app.auth.user_not_found'), 'data' => null], 404);
        }
        if (auth('api')->check() && auth('api')->id() == $user->id) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_send'), 'data' => null], 401);
        }
        $report_story = BlockUser::where([
            'user_id' => auth('api')->id(),
            'blocked_user_id' => $user->id
        ])->first();
        if ($report_story) {
            $report_story->delete();
            return response()->json(['status' => 'true', 'message' => trans('app.client.ban_for_user_has_been_removed', ['username' => $user->username]), 'data' => null], 200);
        } else {
            $report_story = BlockUser::create([
                'user_id' => auth('api')->id(),
                'blocked_user_id' => $user->id
            ]);
            return response()->json(['status' => 'true', 'message' => trans('app.client.user_has_been_banned', ['username' => $user->username]), 'data' => null], 200);
        }
    }

    public function posts(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if ($user_id == null || !$user) {
            return response()->json(['status' => 'false', 'message' => trans('app.auth.user_not_found'), 'data' => null], 404);
        }
        if(!isset($request->type)){
            $type = 'normal';
        }else{
            $type = $request->type;
        }
        if($type == 'fav'){
            $posts = $user->fav_posts()->latest()->paginate(10);
        }else{
            $posts = $user->posts()->where(['user_id' => $user_id, 'activity_type' => $type])->latest()->paginate(10);
        }
        $new_posts = $posts;
        return HomeResource::collection($new_posts)->additional(['status' => 'true', 'message' => '']);
        // return response()->json(['status' => 'true', 'message' => '', 'data' => PostResource::collection($posts)], 200);
    }
}
