<?php

Route::middleware(['guest:admin'])->group(function (){
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
});

Route::middleware(['auth:admin'])->group(function (){
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
});


