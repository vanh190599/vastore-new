<?php

Route::middleware(['guest:customers'])->group(function (){
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('postLogin', 'LoginController@postLogin')->name('postLogin');

    Route::get('/register', 'LoginController@register')->name('register');
    Route::post('/postRegister', 'LoginController@postRegister')->name('postRegister');
});

Route::middleware(['auth:customers'])->group(function (){
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('detail/{slug}-{id}.html', 'ProductController@index')->name('detail.index');

