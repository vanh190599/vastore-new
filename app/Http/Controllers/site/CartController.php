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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        if ($data['qty_update'] > $product->qty ) {
            return back()->with('error', 'Số lượng sản phẩm'.$product->name.' trong kho không đủ (Hiện có: '.$product->qty.')');
        }


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

           /*
           $gmail = $request->email;
           $checkMail = $this->checkExist($gmail);
           if ($checkMail['input01']['Valid'] == "true") {
               return  back()->with('error', 'email không tồn tại');
           }
           */

           $user = auth('customers')->user();
           $brands = $this->brandService->get([])->pluck('name', 'id');
           $data = session('shipping');

           //send main
           $content_mail = $data = Cart::content();
           $receiver_info = $data;
           return view('site.email.index')->with('data', $content_mail);
           dd($receiver_info, $content_mail);
           //end send main

           $shipping = $this->shippingService->create($data);

           $order = [];
           $order['shipping_id'] = $shipping->id;
           $order['total'] = Cart::subtotal();
           $order['user_name_c'] = auth('customers')->user()->name;;
           $order['user_id_c'] = auth('customers')->user()->id;
           $order['date_c'] = time();
           $order['type_payment'] = 1; //tien mat
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
                       'expired_time' => (int) CGlobal::expiredTime($value->model->unit_num, $value->model->unit_label),
                       'date' => time(),
                   ]);
               }
           }

           OrderDetail::insert($data_orderDetails);

           Cart::destroy();
           session()->put('email', null);
           session()->put('receive', null);
           session()->put('phone', null);
           session()->put('address', null);

           //send mail

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

   public function checkExist($gmail){
       $response = Http::post('https://accounts.google.com/InputValidator?resource=signup&service=mail', ['input01' => [
           'Input' => 'GmailAddress', 'GmailAddress' => Str::before($gmail, '@gmail.com'), 'FirstName' => '', 'LastName' => ''
       ], 'Locale' => 'en'])->json();

       return $response;
   }

   public function linkToVNPay(Request $request){
       //$total =  15000000;
       $total =  intval(preg_replace('/[^\d\.]/', '',  Cart::subtotal()));

       $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
       //$vnp_Returnurl = "http://localhost:8089?message=success";
       $vnp_Returnurl = "http://localhost:8080/vastore/public/payment/callback";
       $vnp_TmnCode = "Y4U88XFK"; //Mã website tại VNPAY
       $vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV"; //Chuỗi bí mật

       $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
       $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
       $vnp_OrderType = 'billpayment';
       $vnp_Amount = $total * 100;
       $vnp_Locale = 'vn';
       $vnp_IpAddr = request()->ip();

       $inputData = array(
           "vnp_Version" => "2.0.0",
           "vnp_TmnCode" => $vnp_TmnCode,
           "vnp_Amount" => $vnp_Amount,
           "vnp_Command" => "pay",
           "vnp_CreateDate" => date('YmdHis'),
           "vnp_CurrCode" => "VND",
           "vnp_IpAddr" => $vnp_IpAddr,
           "vnp_Locale" => $vnp_Locale,
           "vnp_OrderInfo" => $vnp_OrderInfo,
           "vnp_OrderType" => $vnp_OrderType,
           "vnp_ReturnUrl" => $vnp_Returnurl,
           "vnp_TxnRef" => $vnp_TxnRef,
       );

       if (isset($vnp_BankCode) && $vnp_BankCode != "") {
           $inputData['vnp_BankCode'] = $vnp_BankCode;
       }
       ksort($inputData);
       $query = "";
       $i = 0;
       $hashdata = "";
       foreach ($inputData as $key => $value) {
           if ($i == 1) {
               $hashdata .= '&' . $key . "=" . $value;
           } else {
               $hashdata .= $key . "=" . $value;
               $i = 1;
           }
           $query .= urlencode($key) . "=" . urlencode($value) . '&';
       }

       $vnp_Url = $vnp_Url . "?" . $query;
       if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
           $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
           $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
       }

       return redirect($vnp_Url);
   }

   public function paymentCallback(Request $request){
       try {
           DB::beginTransaction();
           $data = session('shipping');

           /*
           $gmail = isset($data['email']) ? $data['email'] : '' ;
           $checkMail = $this->checkExist($gmail);
           if ($checkMail['input01']['Valid'] == "true") {
               return  back()->with('error', 'email không tồn tại');
           }
           */

           $user = auth('customers')->user();
           $brands = $this->brandService->get([])->pluck('name', 'id');

           $shipping = $this->shippingService->create($data);

           $order = [];
           $order['shipping_id'] = $shipping->id;
           $order['total'] = Cart::subtotal();
           $order['user_name_c'] = auth('customers')->user()->name;;
           $order['user_id_c'] = auth('customers')->user()->id;
           $order['date_c'] = time();
           $order['type_payment'] = 2; //thanh toan online

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
                       'expired_time' => (int) CGlobal::expiredTime($value->model->unit_num, $value->model->unit_label),
                       'date' => time(),
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

   public function pushShipping(Request $request){
        session(['shipping' => $request->all()]);
        $data = Cart::content();
        return view('site.cart.method_payment', compact('data'));
   }
}
