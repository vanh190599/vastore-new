<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return view('welcome');
});

Route::namespace('Admin')->middleware([])->prefix('admin')->group(function () {
    require 'web/admin.php';
});
