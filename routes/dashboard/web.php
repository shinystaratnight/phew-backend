<?php

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'admin']
    ],
    function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            // Route::get('logout', 'AuthController@signout')->name('logout');
            Route::get('profile', 'AuthController@profile')->name('admin.profile');
            Route::post('update', 'AuthController@update')->name('update.profile');
            Route::post('update_password', 'AuthController@update_password')->name('update.password');

            Route::resource('permission', 'PermissionController');
            Route::resource('admin', 'AdminController');
            Route::resource('client', 'ClientController');
            Route::resource('post', 'PostController');
            Route::resource('country', 'CountryController');
            Route::resource('nationality', 'NationalityController');
            Route::resource('city', 'CityController');
            Route::resource('package', 'PackageController');
            Route::resource('sponsor', 'SponsorController');
            Route::resource('ad', 'AdController');
            
            Route::resource('support', 'SupportController');
            Route::resource('contact', 'ContactController');
            Route::post('reply', 'ContactController@reply')->name('contact.reply');
            
            Route::group(['prefix' => 'setting'], function () {
                Route::get('/', 'SettingController@index')->name('setting.index');
                Route::put('update', 'SettingController@update')->name('setting.update');
            });
            Route::resource('notification', 'NotificationController')->only('index', 'show', 'destroy');
            Route::group(['prefix' => 'notification'], function () {
                Route::post('single/send', 'NotificationController@send_single_notification')->name('notification.send_single');
                Route::post('multiple/send', 'NotificationController@send_multiple_notification')->name('notification.send_multiple');
            });
        });
    }
);
