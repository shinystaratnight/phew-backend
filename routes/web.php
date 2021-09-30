<?php

//Route::view('test','site.pages.jobs.vacant_jobs.create');
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
	],
	function () {
		
		// Dashboard (Has Role)
		Route::get('dashboard/login', "Auth\LoginController@showLoginForm")->name("dashboard.login");
		Route::post('dashboard/login', "Auth\LoginController@login")->name("dashboard.post_login");
		Route::get('dashboard/logout', "Auth\LoginController@logout")->name("dashboard.logout");

		Route::post('setPassword', "Auth\LoginController@storePassword")->name('setPassword');
		Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
		Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
		Route::get('password/reset_form/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset_view');
		Route::post('password/reset_mobile', 'Auth\ResetPasswordController@resetMobile')->name('password.resetToNewMobile');
		Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.resetToNew');

		Route::get('/', 'Website\HomeController@index')->name('website.home');

	}
);
