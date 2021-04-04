<?php

Route::middleware(['guest:admin'])->group(function (){
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');
});

Route::middleware(['auth:admin'])->group(function (){
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::get('dashboard/chart', 'DashboardController@chart')->name('dashboard.index');


    //admin-account
    Route::prefix('admin-account')->group(function (){
        Route::get('search', 'AdminController@search')->name('account.search');
        Route::get('create', 'AdminController@create')->name('account.create');
        Route::post('create', 'AdminController@submitCreate')->name('account.create');

        Route::get('edit', 'AdminController@edit')->name('account.edit');
        Route::post('edit', 'AdminController@submitEdit')->name('account.submitEdit');

        Route::get('get-admin-by-id', 'AdminController@getAdminByID')->name('account.getAdminByID');
        Route::post('change-status', 'AdminController@changeStatus')->name('account.changeStatus');
    });

    //product
    Route::prefix('product')->group(function (){
        Route::get('search', 'ProductController@search')->name('product.search');
        Route::get('create', 'ProductController@create')->name('product.create');
        Route::post('create', 'ProductController@submitCreate')->name('product.create');

        Route::get('edit', 'ProductController@edit')->name('product.edit');
        Route::post('edit', 'ProductController@submitEdit')->name('product.submitEdit');
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

    //news

    //category news
    Route::prefix('category-news')->group(function (){
        Route::get('search', 'CategoryNewsController@search')->name('categoryNews.search');
        Route::get('create', 'CategoryNewsController@create')->name('categoryNews.create');
        Route::post('create', 'CategoryNewsController@submitCreate')->name('categoryNews.create');
        Route::get('edit', 'CategoryNewsController@edit')->name('categoryNews.edit');
        Route::post('edit', 'CategoryNewsController@submitEdit')->name('categoryNews.edit');
        Route::post('delete', 'CategoryNewsController@delete')->name('categoryNews.delete');
    });

    //order
    Route::prefix('order')->group(function (){
        Route::get('/search', 'OrderController@search')->name('order.search');
        Route::get('/detail', 'OrderController@detail')->name('order.detail');
        Route::post('/changeStatus', 'OrderController@changeStatus')->name('order.changeStatus');
    });

    //user
    Route::prefix('customer')->group(function (){
        Route::get('search', 'CustomerController@search')->name('customer.search');
        Route::get('create', 'CustomerController@create')->name('customer.create');
        Route::post('create', 'CustomerController@submitCreate')->name('customer.create');
        Route::get('edit', 'CustomerController@edit')->name('customer.edit');
        Route::post('edit', 'CustomerController@submitEdit')->name('customer.edit');
        Route::post('delete', 'CustomerController@delete')->name('customer.delete');
    });

    //news
    Route::prefix('news')->group(function (){
        Route::get('search', 'NewsController@search')->name('news.search');
        Route::get('create', 'NewsController@create')->name('news.create');
        Route::post('create', 'NewsController@submitCreate')->name('news.create');
        Route::get('edit', 'NewsController@edit')->name('news.edit');
        Route::post('edit', 'NewsController@submitEdit')->name('news.edit');
        Route::post('delete', 'NewsController@delete')->name('news.delete');
    });

    //chart

    Route::post('uploadFile', 'UploadFileController@uploadImage');
    Route::get('export/order/{id}', 'ExportController@exportOrder')->name('export.order');
});

Route::get('test', 'DashboardController@test');
Route::get('twd', 'DashboardController@twd');




