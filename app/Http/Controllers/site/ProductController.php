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

        $product = $this->productService->first(['id' => $id, 'status' => 1]);

        if (!empty($product->colors)) {
            $colors = json_decode($product->colors, true);
            array_push($colors, [
                'name' => 'mặc định',
                'image' => isset($product->image) ? $product->image : ''
            ]);
            $product->colors =  json_encode($colors);
        }

        if (empty($product)) abort(404);

        //related
        $related_search['conditions'][] = ['key' => 'brand_id', 'value' => $product->brand_id];
        $related_search['limit'] = 10;
        $related = $this->productService->search($related_search);

        return view('site.detail.index', compact('product', 'related'));
    }
}




