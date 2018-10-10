<?php

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware(['auth'])->group(function(){

    Route::get('/', 'SiteNavigationController@index')->name('home');

    Route::resource('users', 'UserController')->only(['index', 'store', 'edit', 'update']);
    Route::resource('characters', 'CharacterController')->except(['create', 'edit', 'destroy']);

    Route::resource('downtimeperiods', 'DowntimeperiodController')->except(['create', 'show', 'destroy']);
    Route::resource('downtimes', 'DowntimeController')->except(['create', 'destroy']);
    Route::resource('downtimepoints', 'DowntimepointController')->except(['create', 'edit', 'destroy']);
});
