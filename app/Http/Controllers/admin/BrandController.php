<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Library\CGlobal;
use App\Services\BrandService;
use Illuminate\Http\Request;


class BrandController extends Controller{

    private $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
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

        $data = [
            'conditions' => $conditions,
            'limit' => 50,
            'sortBy' => 'created_at',
            'sortOrder' => 'DESC'
        ];

        $aryStatus = CGlobal::$aryStatusActive;

        $brands = $this->brandService->search($data);

        return view('admin.brand.search',
            compact(
                'brands',
                'aryStatus'
            )
        );

    }

    public function create(){
        $aryStatus = CGlobal::$aryStatusActive;
        return view('admin.brand.create', compact($aryStatus));
    }

    public function submitCreate(BrandRequest $request){
        $data = $request->only('name', 'description', 'image', 'status');

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

        $data = $request->only('name', 'description', 'image', 'status');

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
}
