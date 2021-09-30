<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $guard = auth('api')->check() ? "auth:api" : "web";
        Broadcast::routes(['middleware' => $guard]);

        require base_path('routes/channels.php');
    }
}
