<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateRequest;
use App\Library\CGlobal;
use App\Model\MySql\Product;
use App\Model\MySql\ProductLog;
use App\Services\AdminService;
use App\Services\BrandService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller{
    private $adminService;
    private $brandService;
    private $productService;
    private $log;

    public function __construct(
        AdminService $adminService,
        BrandService $brandService,
        ProductService $productService,
        ProductLog $log
    )
    {
        $this->adminService = $adminService;
        $this->brandService = $brandService;
        $this->productService = $productService;
        $this->log = $log;
    }

    public function search(Request $request)
    {
        $conditions = [];
        if (! empty($request->name)) {
            array_push($conditions, [
                'key' => 'name',
                'value' => $request->name,
                'operator' => 'like'
            ]);
        }

        if (! empty($request->id)) {
            array_push($conditions, [
                'key' => 'id',
                'value' => $request->id,
            ]);
        }

        if (! empty($request->brand)) {
            array_push($conditions, [
                'key' => 'brand_id',
                'value' => $request->brand,
            ]);
        }

        if (isset($request->status) && $request->status != -1) {
            array_push($conditions, [
                'key' => 'status',
                'value' => (int)$request->status,
            ]);
        }

        $data = [
            'conditions' => $conditions,
            'limit' => 10,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

        if (isset($request->filter) && $request->filter != -1) {
            if ((int) $request->filter == 0) { // Tăng dần
                $data = [
                    'conditions' => $conditions,
                    'limit' => 10,
                    'sortBy' => 'sold',
                    'sortOrder' => 'DESC'
                ];
            }  else { //Giảm dần
                $data = [
                    'conditions' => $conditions,
                    'limit' => 10,
                    'sortBy' => 'sold',
                    'sortOrder' => 'ASC'
                ];
            }
        }

        $aryStatus = CGlobal::$aryStatusShow;

        $products = $this->productService->search($data);
        $products->load('brand');
        //dd($products);

        return view('admin.product.search', compact(
            'products', 'aryStatus'
        ));
    }

    public function create(){
        $brands = $this->brandService->get([])->pluck('name', 'id')->toArray();
        $aryLabel = CGlobal::$aryLable;
        return view('admin.product.create', compact(
            'brands', 'aryLabel'
        ));
    }

    public function submitCreate(Request $request) {
        $request->flash();
        $data = $request->all();

        $this->productService->createProduct($data);

        return redirect()->route('admin.product.search');
    }

    public function edit(Request $request){
        $product = $this->productService->first(['id'=>$request->id]);
        $brands = $this->brandService->get([])->pluck('name', 'id')->toArray();
        $aryLabel = CGlobal::$aryLable;
        return view('admin.product.edit', compact('product', 'brands', 'aryLabel' ));
    }

    public function submitEdit(Request $request){
        $request->flash();
        $params = $request->all();

        $this->productService->editProduct($params);
        return redirect()->route('admin.product.search');
    }

    public function log(Request $request){
        $log = $this->log->where('product_id', $request->id)->orderBy('id', 'desc')->paginate(10);

        return view('admin.product.log', compact('log'));
    }

    public function changeStatus(Request $request) {
        $id = $request->id;
        $product = Product::find($id);

        if (!empty($product)) {
            if ($product->status == 1) {
                $product->status = 0;
                $product->save();
                return response(['success' => 1, 'message' => 'Đã ẩn sản phẩm']);
            } else {
                $product->status = 1;
                $product->save();
                return response(['success' => 1, 'message' => 'Đã hiển thị sản phẩm']);
            }
        }

        return response(['success' => 1, 'message' => 'Sản phẩm không tồn tại']);
    }

    public function delete(Request $request){
        $params = $request->all();
        $product = $this->productService->deleteProduct($params);

        if (! empty($product)) {
            return response(['success' => 1, 'message' => 'Xóa thành công!']);
        }

        return response(['success' => 0, 'message' => 'Có lỗi xảy ra!']);
    }
}
