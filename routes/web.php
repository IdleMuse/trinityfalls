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

Route::get('/font-preview', 'SiteNavigationController@fontpreview')->name('fontpreview');

Route::middleware(['auth'])->group(function(){

    Route::get('/', 'SiteNavigationController@index')->name('home');

    Route::resource('menulinks', 'MenulinkController')->only(['index', 'store', 'update', 'destroy']);

    Route::resource('users', 'UserController')->only(['index', 'store', 'edit', 'update']);
    Route::resource('characters', 'CharacterController')->only(['index', 'store', 'show', 'update']);

    Route::resource('xpdeltas', 'XpdeltaController')->only(['index', 'store', 'update', 'destroy']);

    Route::resource('downtimeperiods', 'DowntimeperiodController')->only(['index', 'store', 'show', 'edit', 'update']);;
    Route::resource('downtimes', 'DowntimeController')->only(['store', 'show', 'edit']);
    Route::resource('downtimepoints', 'DowntimepointController')->only(['store', 'show', 'edit', 'update', 'destroy']);

    Route::resource('skills', 'SkillController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('skillranks', 'SkillrankController')->only(['store', 'update', 'destroy']);

    Route::resource('aptitudes', 'AptitudeController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('aptituderanks', 'AptituderankController')->only(['store', 'update', 'destroy']);

    Route::resource('inventoryitems', 'InventoryitemController')->only(['store', 'update', 'destroy']);
});

// only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
