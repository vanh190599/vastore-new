<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->middleware([])->name('admin.')->prefix('admin')->group(function () {
    require 'admin/admin.php';
});

Route::namespace('Site')->middleware([])->name('site.')->prefix('admin')->group(function () {
    //require 'site';
});
