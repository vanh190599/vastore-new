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

    public function list(Request $request){
        $conditions = [];
        if (! empty($request->brand_id)) {
            array_push($conditions, [
                'key' => 'brand_id',
                'value' => $request->brand_id,
            ]);
        }
        if (! empty($request->name)) {
            array_push($conditions, [
                'key' => 'name',
                'value' => $request->name,
                'operator' => 'name'
            ]);
        }

        array_push($conditions, [
            'key' => 'status',
            'value' => 1,
        ]);


        $data = [
            'conditions' => $conditions,
            'limit' => 50,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

        //dd($data);

        $products = $this->productService->get($data);
        return view('site.list.index', compact(
            'products'
        ));
    }
}
