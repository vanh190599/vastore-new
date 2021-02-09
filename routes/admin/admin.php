<?php

Route::middleware(['guest:admin'])->group(function (){
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
});

Route::middleware(['auth:admin'])->group(function (){
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    //admin
    Route::prefix('admin-account')->group(function (){
        Route::get('search', 'AdminController@search')->name('account.search');
        Route::get('create', 'AdminController@create')->name('account.create');
        Route::post('create', 'AdminController@submitCreate')->name('account.create');

        Route::get('get-admin-by-id', 'AdminController@getAdminByID')->name('account.getAdminByID');
        Route::post('change-status', 'AdminController@changeStatus')->name('account.changeStatus');
    });
});

Route::get('test', 'DashboardController@test');
Route::get('twd', 'DashboardController@twd');


