<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer([
            'dashboard.parts.sidebar',
        ], function ($view) {
            $view->with('locale', app()->getLocale());
        });

        view()->composer([
            'site.layouts.banner.left_side',
            'site.layouts.banner.right_side',
        ], function ($view) {
            $view->with('ad_sliders', \App\Models\AdSlider::get());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
