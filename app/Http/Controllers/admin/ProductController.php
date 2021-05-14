<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateRequest;
use App\Library\CGlobal;
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

        if (! empty($request->is_active)) {
            array_push($conditions, [
                'key' => 'is_active',
                'value' => (int)$request->is_active,
            ]);
        }

        $data = [
            'conditions' => $conditions,
            'limit' => 10,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

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
        $data = $request->only([
            "name",
            'brand_id',
            "price",
            "price_discount",
            "unit_num",
            "unit_label",
            "release_date",
            "height",
            "width",
            "depth",
            "tech_screen",
            "size",
            "cpu",
            "ram",
            "rom",
            "battery_capacity",
            "camera_before",
            "camera_after",
            "description",
            "image",
            "status",
            "attach",
            "attach_image",
            "qty",
            "sold",
            "colors",
        ]);
        $data["release_date"] = strtotime($data["release_date"]);

        $product = $this->productService->first(['id'=>$request->id]);
        $this->productService->edit($product, $data);
        return redirect()->route('admin.product.search');
    }

    public function log(Request $request){
        $log = $this->log->where('product_id', $request->id)->orderBy('id', 'desc')->paginate(10);

        return view('admin.product.log', compact('log'));
    }
}
