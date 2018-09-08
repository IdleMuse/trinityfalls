<?php

Auth::routes();

Route::middleware(['auth'])->group(function(){

    Route::get('/', 'SiteNavigationController@index')->name('home');

    Route::resource('characters', 'CharacterController')->except(["destroy"]);

});
