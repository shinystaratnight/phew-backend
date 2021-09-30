<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => 'Api',
], function () {
    Route::group(['middleware' => 'setLocale'], function () {

        Route::get('countries', 'CountryController@index');
        Route::get('nationalities', 'CountryController@nationalities');
        Route::get('countries/{country_id}/cities', 'CountryController@cities');
        Route::get('search', 'SearchController@index');
        Route::get('packages', 'PackageController@index');
        Route::get('movies', 'SettingController@movies');

        Route::group(['prefix' => 'findly'], function () {
            Route::get('countries', 'FindlyController@index');
            Route::get('countries/{country_id}/cities', 'FindlyController@cities');
            Route::get('countries/{country_id}/cities/{city_id}', 'FindlyController@posts');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('about', 'SettingController@about');
            Route::get('conditions_terms', 'SettingController@conditions_terms');
            Route::get('social_info', 'SettingController@social_info');
            Route::post('contact', 'ContactController@contact');
        });

        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', 'ClientController@login');
            Route::post('social_login', 'SocialAuthController@login');
            Route::post('register', 'ClientController@register');
            Route::post('verify', 'ClientController@verify');
            Route::post('resend/code', 'ClientController@resend_code');

            Route::post('forgot_password', 'ClientController@forgot_password');
            Route::post('reset_password', "ClientController@reset_password");
        });

        Route::group(['middleware' => ['auth:api', 'user']], function () {
            Route::group(['prefix' => 'auth'], function () {
                Route::post('logout', 'ClientController@logout');
                Route::put('update_profile', "ClientController@update_profile");
                Route::put('update_setting', "ClientController@update_setting");
                Route::put('subscribe_pacakge/{package_id}', "PackageController@update");
                Route::put('update_package_setting', "ClientController@update_package_setting");
                Route::put('update_password', "ClientController@update_password");
                Route::delete('image/{image_id}', "ClientController@delete_image");
            });

            Route::group(['prefix' => 'users'], function () {
                Route::get('{user_id}', "ClientController@profile");

                Route::post('{user_id}/block', "ClientController@block");
                Route::post('{user_id}/follow', "FollowController@follow");
                Route::post('{user_id}/secret_message', "SecretMessageController@send");

                Route::get('{user_id}/followers', "FollowController@followers");
                Route::get('{user_id}/followings', "FollowController@followings");
                Route::get('{user_id}/fav_posts', "FavPostController@fav_posts");
                Route::get('{user_id}/like_posts', "LikePostController@like_posts");
                Route::get('{user_id}/posts', "ClientController@posts");


                Route::group(['prefix' => '{user_id}/friends'], function () {
                    Route::get('/', "FriendController@index");
                    Route::post('remove', "FriendController@remove");
                });

                Route::group(['prefix' => '{user_id}/friend_request'], function () {
                    Route::get('/', "FriendRequestController@index");
                    Route::post('send', "FriendRequestController@send");
                    Route::post('cancel', "FriendRequestController@cancel");
                    Route::post('accept', "FriendRequestController@accept");
                    Route::post('reject', "FriendRequestController@reject");
                });

                Route::group(['prefix' => '{user_id}/block'], function () {
                    Route::get('/', "BlockController@index");
                    Route::post('add', "BlockController@add");
                    Route::post('remove', "BlockController@remove");
                });
            });

            Route::post('hide_ad/{ad_id}', "PostController@hide_ad");
            Route::post('screen_shot', "ScreenShotPostController@store_multi");
            Route::apiResource('posts', "PostController");
            Route::apiResource('posts/{post_id}/comments', "CommentController");
            Route::group(['prefix' => 'posts'], function () {
                Route::PUT('{post_id}/update_privacy', "PostController@update_privacy");
                Route::post('{post_id}/like', "LikePostController@store");
                Route::post('{post_id}/screen_shot', "ScreenShotPostController@store");
                Route::post('{post_id}/findly', "FindlyController@store");
                Route::post('{post_id}/fav', "FavPostController@store");
            });
            Route::apiResource('comments/{comment_id}/comments', "ReplyCommentController");

            Route::group(['prefix' => 'chats'], function () {
                Route::get('/', 'ChatController@index');
                Route::get('{user_id}', 'ChatController@show');
                Route::post('{user_id}', 'ChatController@send');
                Route::delete('{user_id}/messages/{message_id}', 'ChatController@delete_message');
            });

            Route::group(['prefix' => 'secret_message'], function () {
                Route::get('/', 'SecretMessageController@index');
                Route::get('{message_id}', 'SecretMessageController@show');
                Route::post('{message_id}', 'SecretMessageController@reply');
                Route::delete('{message_id}', 'SecretMessageController@destroy');
            });

            Route::group(['prefix' => 'notifications'], function () {
                Route::get('/', "NotificationController@index");
                Route::delete('{notification_id}', "NotificationController@destroy");
            });
        });
    });
});
