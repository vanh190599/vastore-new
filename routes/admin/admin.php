<?php

Route::middleware(['guest:admin'])->group(function (){
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
});

Route::middleware(['auth:admin'])->group(function (){
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    //admin-account
    Route::prefix('admin-account')->group(function (){
        Route::get('search', 'AdminController@search')->name('account.search');
        Route::get('create', 'AdminController@create')->name('account.create');
        Route::post('create', 'AdminController@submitCreate')->name('account.create');
        Route::post('delete', 'AdminController@delete')->name('account.delete');

        Route::get('get-admin-by-id', 'AdminController@getAdminByID')->name('account.getAdminByID');
        Route::post('change-status', 'AdminController@changeStatus')->name('account.changeStatus');
    });

    //product
    Route::prefix('product')->group(function (){
        Route::get('search', 'ProductController@search')->name('product.search');
        Route::get('create', 'ProductController@create')->name('product.create');
        Route::post('create', 'ProductController@submitCreate')->name('product.create');
    });

    //brand
    Route::prefix('brand')->group(function (){
        Route::get('search', 'BrandController@search')->name('brand.search');
        Route::get('create', 'BrandController@create')->name('brand.create');
        Route::post('create', 'BrandController@submitCreate')->name('brand.create');
        Route::get('edit', 'BrandController@edit')->name('brand.edit');
        Route::post('edit', 'BrandController@submitEdit')->name('brand.edit');
        Route::post('delete', 'BrandController@delete')->name('brand.delete');
    });

    Route::post('uploadFile', 'UploadFileController@uploadImage');
});

Route::get('test', 'DashboardController@test');
Route::get('twd', 'DashboardController@twd');


