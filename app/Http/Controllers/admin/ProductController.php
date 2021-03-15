<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\CreateRequest;
use App\Library\CGlobal;
use App\Services\AdminService;
use App\Services\BrandService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller{
    private $adminService;

    private $brandService;

    private $productService;

    public function __construct(
        AdminService $adminService,
        BrandService $brandService,
        ProductService $productService
    )
    {
        $this->adminService = $adminService;
        $this->brandService = $brandService;
        $this->productService = $productService;
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
        if (! empty($request->email)) {
            array_push($conditions, [
                'key' => 'email',
                'value' => $request->email,
            ]);
        }
        if (! empty($request->is_active)) {
            array_push($conditions, [
                'key' => 'is_active',
                'value' => (int)$request->is_active,
            ]);
        }
        if (! empty($request->phone)) {
            array_push($conditions, [
                'key' => 'phone',
                'value' => (int)$request->phone,
            ]);
        }

        $data = [
            'conditions' => $conditions,
            'limit' => 50,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

        $aryStatus = CGlobal::$aryStatusActive;

        //$admins = $this->adminService->search($data);
        return view('admin.product.search');
            //->with('admins', $admins)
            //->with('aryStatus', $aryStatus);
    }

    public function create(){
        $brands = $this->brandService->get([])->pluck('name', 'id')->toArray();
        return view('admin.product.create', compact(
            'brands'
        ));
    }

    public function submitCreate(Request $request) {
        $data = $request->only([
            "name",
            'brand',
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
            "status"
        ]);

        $data['unit_label'] = 1;
        $data['height'] = 1;
        $data['image'] = 1;

        $this->productService->create($data);
        dd('ok');
    }
}
