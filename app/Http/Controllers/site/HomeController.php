<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\Controller;
use App\Library\CGlobal;
use App\Services\orderService;
use App\Services\ProductService;
use App\Services\ShippingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

session_start();
class HomeController extends Controller{

    private $productService;
    private $orderController;
    private $shippingService;

    public function __construct(
        ProductService  $productService,
        orderService $orderService,
        ShippingService $shippingService
    )
    {
        $this->productService  = $productService;
        $this->orderService    = $orderService;
        $this->shippingService = $shippingService;
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
                'operator' => 'like'
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

        //dd($data);

        if (! empty($request->filter)) {
            if ($request->filter) {
                $arr = explode('-', $request->filter);
                $start = (int) $arr[0];
                $end = (int) end($arr);
            };
            $data['filter'] = ['start' => $start, 'end' => $end];
        }

        $brand_id = isset($request->brand_id) ? $request->brand_id : '';
        $products = $this->productService->search($data);

        return view('site.list.index', compact(
            'products', 'brand_id'
        ));
    }

    public function lookUp(){
        return view('site.look_up.index');
    }

    public function submitLookUp(Request $request){
        $phone = $request->phone;
        $data = [];
        $data['conditions'][] = ['key' => 'phone', 'value'=>$phone];
        $shippings = $this->shippingService->get($data);
        $shipping_ids = $shippings->pluck('id');
        $shipping_names = $shippings->pluck('receive', 'id');

        $data = [];
        $data['conditions'][] = ['key' => 'shipping_id' , 'value' => $shipping_ids, 'operator' => 'in'];
        $orders = $this->orderService->get($data);
        //$orders->load('details');
        $orders->load(["details" => function ($q) {
            $q->where('status', 1);
        }]);

        $products = [];
        if (sizeof($orders) > 0) {
            foreach ($orders as $key => $order) {
                if (sizeof($order->details) > 0) {
                    foreach ($order->details as $key2 => $value) {
                        $value['receive'] = isset($shipping_names[$order->shipping_id]) ? $shipping_names[$order->shipping_id] : '';
                        $products[] = $value;
                    }
                }
            }
        }

        return view('site.look_up.index', compact('products', 'shipping_names'));
    }

    public function sendMail(){
        $data = [];
        Mail::send('site.email.index', $data, function ($msg) {
            $msg->from('anh195np@gmail.com', 'Nguyen Van Anh');
            $msg->to('facebook19051999@gmail.com', 'Nguyen Van Anh')->subject('VASTORE SEND SUCCESS!');
        });
    }
}
