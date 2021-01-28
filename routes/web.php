<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('welcome');
});

Route::namespace('admin')->group(function () {
    Route::middleware(['auth:admin'])->group(function (){
//        Route::get('dasboard', 'LoginController@postLogin')->name('postLogin');
    });

    Route::middleware(['guest:admin'])->group(function (){
        Route::get('login', 'LoginController@login')->name('login');
        Route::get('postLogin', 'LoginController@postLogin')->name('postLogin');
    });
});

