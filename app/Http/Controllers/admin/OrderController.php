<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Library\CGlobal;

use App\Services\BrandService;
use App\Services\OrderDetailService;
use App\Services\orderService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class OrderController extends Controller {

    private $brandService;
    private $orderService;
    private $orderDetailService;
    private $productService;

    public function __construct(
        orderService $orderService,
        BrandService $brandService,
        OrderDetailService $orderDetailService,
        ProductService $productService
    )
    {
        $this->brandService = $brandService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->productService = $productService;
    }

    public function search(Request $request)
    {
        $conditions = [];
        if (! empty($request->id)) {
            array_push($conditions, [
                'key' => 'id',
                'value' => $request->id,
            ]);
        }

        if (! empty($request->user_name_c)) {
            array_push($conditions, [
                'key' => 'user_name_c',
                'value' => $request->user_name_c,
            ]);
        }

        $data = [
            'conditions' => $conditions,
            'limit' => 50,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

        $orders = $this->orderService->search($data);
        $orders->load('details', 'shipping');
//        dd($orders);
        return view('admin.order.index',
            compact('orders')
        );

    }

    public function create(){
        $aryStatus = CGlobal::$aryStatusActive;
        return view('admin.brand.create', compact($aryStatus));
    }

    public function submitCreate(BrandRequest $request){
        $data = $request->only('name', 'description');

        $brand = $this->brandService->create($data);

        return redirect()->route('admin.brand.search')->with('success_message', $brand->name.' Đã được tạo');
    }

    public function edit(Request $request){
        $brand = $this->brandService->first(['id' => $request->id]);

        if (empty($brand)) {
            return redirect()->route('admin.brand.search')->with('error_message', 'Thương hiệu không tồn tại');
        }

        return view('admin.brand.edit', compact('brand'));
    }

    public function submitEdit(BrandRequest $request){
        $brand = $this->brandService->first(['id' => $request->id]);

        if (empty($brand)) {
            return redirect()->route('admin.brand.search')->with('error_message', 'Thương hiệu không tồn tại');
        }

        $data = $request->only('name', 'description');

        $this->brandService->edit($brand, $data);

        return redirect()->route('admin.brand.search')->with('success_message', 'Sửa thương hiệu thành công');
    }

    public function delete(Request $request){
        $admin = $this->brandService->first(['id' => $request->id]);

        if (empty($admin)) {
            return response(['success'=>0, 'message'=>'Thương hiệu không tồn tại']);
        }

        $this->brandService->delete(['id' =>  $request->id]);

        return response(['success'=>1, 'message'=>'Xóa thành công']);
    }

    public function detail(Request $request)
    {
        $conditions = [];

        array_push($conditions, [
            'key' => 'order_id',
            'value' => $request->order_id,
        ]);

        if (! empty($request->user_name_c)) {
            array_push($conditions, [
                'key' => 'user_name_c',
                'value' => $request->user_name_c,
            ]);
        }

        $data = [
            'conditions' => $conditions,
            'limit' => 50,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

        $details = $this->orderDetailService->search($data);


        return view('admin.order.detail',
            compact('details')
        );
    }

    public function changeStatus(Request $request){
        try {
            DB::beginTransaction();

            $orderDetail = $this->orderDetailService->first(['id'=>$request->id]);
            $status = $request->status == 0 ? 1 : 0;
            $mess = $request->status == 0 ? 'Đã nhận' : 'Chưa nhận';
            $orderDetail = $this->orderDetailService->edit($orderDetail, ['status'=>$status]);

            //update so luong
            $product = $this->productService->first(['id'=>$orderDetail->product_id]);
            $update_qty = $orderDetail->status == 1 ? (int) $product->qty - (int) $orderDetail->qty : (int) $product->qty + (int) $orderDetail->qty;
            $update_sold = $orderDetail->status == 1 ? (int) $product->sold + (int) $orderDetail->qty : (int) $product->sold - (int) $orderDetail->qty;

            if($update_qty < 0 || $update_sold < 0) {
                return response(['success'=>false, 'message'=>'Có lỗi xảy ra!']);
            }

            $this->productService->edit($product, ['qty'=>(int) $update_qty, 'sold'=>$update_sold]);

            DB::commit();
            return response(['success'=>true, 'message'=>$mess]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
