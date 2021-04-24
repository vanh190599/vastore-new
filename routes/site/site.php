<?php

Route::middleware(['guest:customers'])->group(function (){
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');

    Route::get('/register', 'LoginController@register')->name('register');
    Route::post('/postRegister', 'LoginController@postRegister')->name('postRegister');
});

Route::get('/look-up', 'HomeController@lookUp')->name('lookUp');
Route::get('/submit-look-up', 'HomeController@submitLookUp')->name('submitLookUp');

Route::middleware(['auth:customers'])->group(function (){
    Route::post('logout', 'LoginController@logout')->name('logout');

    //cart - shipping
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/add-cart', 'CartController@addCart')->name('cart.addCart');
    Route::post('/delete-cart', 'CartController@delete')->name('cart.delete');
    Route::post('/update-cart', 'CartController@update')->name('cart.update');
    Route::get('/shipping', 'CartController@shipping')->name('cart.shipping');
    Route::post('/postShipping', 'CartController@postShipping')->name('cart.postShipping');
    Route::get('/shipping/create', 'CartController@createShipping')->name('cart.createShipping');
    Route::get('/shipping/finish', 'CartController@finish')->name('cart.finish');



});

//Route::get('/cart', 'CartController@index')->name('cart');

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/list', 'HomeController@list')->name('list.index');
Route::get('detail/{slug}-{id}.html', 'ProductController@index')->name('detail.index');
Route::get('news/', 'NewsController@index')->name('news.index');
Route::get('news/detail', 'NewsController@detail')->name('news.detail');

