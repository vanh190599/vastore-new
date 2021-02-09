<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\CGlobal;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller{
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

        $admins = $this->adminService->search($data);
        return view('admin.account.search')
            ->with('admins', $admins)
            ->with('aryStatus', $aryStatus);
    }

    public function create(){
        return view('admin.account.create');
    }

    public function changeStatus(Request $request){
        $admin = $this->adminService->first(['id'=>$request->id]);
        if (empty($admin)) {
            return response(['success' => 0, 'message' => 'Không tồn tại tài khoản này']);
        }

        // active & block
        if ($admin->is_active == CGlobal::STATUS_ACTIVE) { //block
            $admin =  $this->adminService->edit($admin, ['is_active'=>CGlobal::STATUS_BLOCK]);
            return response(['success' => 1, 'message' => 'Khóa thành công', 'data'=>$admin]);
        }
        elseif ($admin->is_active == CGlobal::STATUS_BLOCK) {
            $admin =  $this->adminService->edit($admin, ['is_active'=>CGlobal::STATUS_ACTIVE]);
            return response(['success' => 1, 'message' => 'Kích hoạt thành công', 'data'=>$admin]);
        }
    }

    public function getAdminByID(Request $request){
        $admin = $this->adminService->first(['id'=>$request->id]);
        if (empty($admin)) {
            return response(['success' => 0, 'message' => 'Không tồn tại tài khoản này']);
        }

        return response(['success' => 1, 'data' => $admin]);
    }
}
