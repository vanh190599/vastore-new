<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;


class UploadFileController extends Controller{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function uploadImage(Request $request)
    {
        $file = $request->file('file');
        if (empty($file)) {
            return response()->json(['success' => 0, 'mess' => 'File không tồn tại']);
        }

        $fileName = $file->getClientOriginalName();
        $fileExt = strtolower($file->getClientOriginalExtension());
        $filePath = $file->getPathName();
        $mine_type = mime_content_type($filePath);

        $allow_mine_type = [
            'image/png',
            'image/jpeg',
            'image/webp',
        ];

        $allow_ext = ['png', 'jpg', 'jpeg'];
        if (!in_array($mine_type, $allow_mine_type) || !in_array($fileExt, $allow_ext)) {
            return response()->json(['success' => 0, 'mess' => 'File không đúng định dạng!']);
        }

        //di chuyển
        $file_name = time().'_'.$fileName;
        $file->move('admin/upload/product', $file_name);

        return response(['success'=>1, 'message'=> 'Tải ảnh lên thành công', 'data'=>$file_name]);
    }
}
