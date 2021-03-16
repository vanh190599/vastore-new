<?php

namespace App\Providers;

use App\Model\MySql\Brand;
use App\Services\BrandService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data_brand = Brand::all();
        View::share('data_brand', $data_brand);
    }
}
