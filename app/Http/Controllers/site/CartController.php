<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Library\CGlobal;
use App\Model\MySql\Order;
use App\Model\MySql\OrderDetail;
use App\Services\BrandService;
use App\Services\orderService;
use App\Services\ProductService;
use App\Services\ShippingService;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

session_start();
class CartController extends Controller {

    private $brandService;
    private $productService;
    private $shippingService;
    private $orderService;

    public function __construct(
        BrandService $brandService,
        ProductService $productService,
        ShippingService $shippingService,
        orderService $orderService
    )
    {
        $this->brandService = $brandService;
        $this->productService = $productService;
        $this->shippingService = $shippingService;
        $this->orderService = $orderService;
    }

    public function index(Request $request){
        $data = Cart::content();
        return view('site.cart.index', compact('data', 'aryImg'));
    }

    public function addCart(Request $request){
        $product = $this->productService->first(['id' => $request->id]);
        $qty = 1;

        Cart::add(
            $product->id,
            $product->name,
            $qty,
            $product->price_discount > 0 ? $product->price_discount : $product->price,
            []
        )->associate($product);

        return redirect()->route('site.cart.index');
    }

    public function delete(Request $request) {
        $rowID = $request->rowID;
        Cart::remove($rowID);
        return redirect()->route('site.cart.index');
    }

    public function update(Request $request) {
        $product = $this->productService->first(['id' => $request->id]);
        $data = $request->all();
        $rowID = $data['rowID'];
        $qty_update = $data['qty_update'] >= 0 ? $data['qty_update'] : 1;
        $cart = Cart::get($rowID);
        Cart::update($rowID, array(
            'qty' => $qty_update, // new item name
        ));
        return redirect()->route('site.cart.index');
    }

   public function shipping(){
        return view('site.cart.shipping');
   }

   public function postShipping(Request $request){
       try {
           DB::beginTransaction();

           $user = auth('customers')->user();
           $brands = $this->brandService->get([])->pluck('name', 'id');
           $data = $request->only('address', 'receive', 'email', 'phone');
           $shipping = $this->shippingService->create($data);

           $order = [];
           $order['shipping_id'] = $shipping->id;
           $order['total'] = Cart::subtotal();
           $order['user_name_c'] = auth('customers')->user()->name;;
           $order['user_id_c'] = auth('customers')->user()->id;
           $order['date_c'] = time();
           $order = $this->orderService->create($order);

           $data = Cart::content();
           if(empty($data)) return redirect()->route('site.home.index');
           $data_orderDetails = array();
           if (sizeof($data) > 0) {
               foreach ($data as $key => $value) {
                   array_push($data_orderDetails, [
                       'order_id' =>$order->id,
                       'product_id' => $value->model->id,
                       'product_name' => $value->model->name,
                       'product_image' => $value->model->image,
                       'brand_name' => isset($brands[$value->model->brand_id]) ? $brands[$value->model->brand_id] : '',
                       'price' => $value->model->discount > 0 ? $value->model->discount : $value->model->price ,
                       'qty' => $value->qty,
                       'total' => $value->qty * $value->price,
                   ]);
               }
           }
           OrderDetail::insert($data_orderDetails);

           Cart::destroy();


           DB::commit();
           return redirect()->route('site.cart.finish');
       } catch (Exception $e) {
           DB::rollBack();
           throw $e;
       }
   }

   public function finish(){
        return view('site.cart.finish');
   }
}
