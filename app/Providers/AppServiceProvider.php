<?php

namespace App\Providers;

use App\Model\MySql\Brand;
use App\Model\MySql\CategoryNew;
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
        $data_brand = Brand::where('status', 1)->get();
        View::share('data_brand', $data_brand);

        $cate_news = CategoryNew::all();
        View::share('cate_news', $cate_news);
    }
}
