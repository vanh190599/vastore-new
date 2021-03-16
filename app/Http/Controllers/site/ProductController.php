<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\CreateRequest;
use App\Library\CGlobal;
use App\Services\AdminService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller{

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($lug, $id)
    {
        if ($id) {
            $arrId = explode('-', $id);
            $id = end($arrId);
        };

        $product = $this->productService->first(['id' => $id]);
        if (empty($product)) abort(404);

        return view('site.detail.index', compact('product'));
    }
}




