<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\CreateRequest;
use App\Library\CGlobal;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
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
        return view('admin.product.create');
    }
}
