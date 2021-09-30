<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Package\{PackageResource};
use App\Models\{Package, PackageUser};
use Carbon\Carbon;
use App\Http\Resources\User\{AuthResource};

class PackageController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'true', 'message' => '', 'data' => PackageResource::collection(Package::where('package_type', 'paid')->get())], 200);
    }

    public function update($package_id)
    {
        $package = Package::where('package_type', 'paid')->findOrFail($package_id);
        $user = auth('api')->user();
        $current_user_package = auth('api')->user()->package_user()->where('package_type', 'paid')->latest()->first();
        if ($current_user_package && $current_user_package->subscription_end_date >= date('Y-m-d')) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.you_cannot_change_the_subscription_when_the_previous_package_subscription_ends'), 'data' => null], 422);
        }

        if ($package->period_type == 'hours') {
            $subscription_end_date = Carbon::now()->addHours($package->period);
        } elseif ($package->period_type == 'days') {
            $subscription_end_date = Carbon::now()->addDays($package->period);
        } elseif ($package->period_type == 'weeks') {
            $subscription_end_date = Carbon::now()->addWeeks($package->period);
        } elseif ($package->period_type == 'months') {
            $subscription_end_date = Carbon::now()->addMonths($package->period);
        } elseif ($package->period_type == 'years') {
            $subscription_end_date = Carbon::now()->addYears($package->period);
        }
        $user_package = PackageUser::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'package_type' => $package->package_type,
            'subscription_start_date' => now(),
            'subscription_end_date' => now()->add($package->period, $package->period_type),
            'information' => json_encode($package),
        ]);
        return response()->json(['status' => 'true', 'message' => trans('app.messages.successful_subscription'), 'data' => new AuthResource($user)], 200);
    }
}
