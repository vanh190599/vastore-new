<?php

use Illuminate\Support\Facades\Route;

Route::namespace('admin')->middleware([])->name('admin.')->prefix('admin')->group(function () {
    require 'admin/admin.php';
});

Route::namespace('site')->middleware([])->name('site.')->group(function () {
    require 'site/site.php';
});
