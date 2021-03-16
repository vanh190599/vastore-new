<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\CreateRequest;
use App\Library\CGlobal;
use App\Services\AdminService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $data['conditions'][] = ['key'=>'status', 'value'=>CGlobal::STATUS_SHOW];
        $products = $this->productService->get($data);
        $products->load('brand');
        $aryStatus = CGlobal::$aryStatusActive;
        return view('site.home.index', compact(
            'products'
        ));
    }
}
