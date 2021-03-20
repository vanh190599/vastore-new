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
        //MOI
        $data['conditions'][] = ['key'=>'status', 'value'=>CGlobal::STATUS_SHOW];
        $data['limit'] = 9;
        $data['sortBy'] = 'id';
        $data['sortOrder'] = 'desc';
        $products = $this->productService->search($data);
        $products->load('brand');

        //KHUYEN MAI
        $discounts = array();
        if (sizeof($products) > 0) {
            foreach ($products as $k => $v) {
                if ($v->price_discount > 0) {
                    $discounts[] = $v;
                }
            }
        }

        //BAN CHAY
        $data_top_sale = array();
        $data_top_sale['conditions'][] = ['key'=>'status', 'value'=>CGlobal::STATUS_SHOW];
        $data_top_sale['conditions'][] = ['key'=>'sold',  'value'=>0, 'operator' => '>'];
        $data_top_sale['sortBy'] = 'sold';
        $data_top_sale['sortOrder'] = 'DESC';
        $data_top_sale['limit'] = 9;
        $top_sale = $this->productService->search($data_top_sale)->take(8);

        return view('site.home.index', compact(
            'products', 'discounts', 'top_sale'
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
            'sortBy' => 'id',
            'sortOrder' => 'DESC'
        ];

        $products = $this->productService->search($data);
        return view('site.list.index', compact(
            'products'
        ));
    }
}
