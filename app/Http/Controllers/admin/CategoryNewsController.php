<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Library\CGlobal;
use App\Services\categoryNewsService;
use Illuminate\Http\Request;


class CategoryNewsController extends Controller{

    private $categoryNewsService;

    public function __construct(CategoryNewsService $categoryNewsService)
    {
        $this->categoryNewsService = $categoryNewsService;
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

        $brands = $this->categoryNewsService->search($data);

        return view('admin.brand.search',
            compact(
                'brands',
                'aryStatus'
            )
        );

    }

    public function create(){
        $aryStatus = CGlobal::$aryStatusActive;
        return view('admin.category_news.create', compact('aryStatus'));
    }

    public function submitCreate(BrandRequest $request){
        $data = $request->only('name', 'description');
        $brand = $this->categoryNewsService->create($data);
        return redirect()->route('admin.categoryNews.search')->with('success_message', 'Tạo thành công');
    }

    public function edit(Request $request){
        $categoryNews = $this->categoryNewsService->first(['id' => $request->id]);

        if (empty($brand)) {
            return redirect()->route('admin.categoryNews.search')->with('error_message', 'Danh mục không tồn tại');
        }

        return view('admin.categoryNews.edit', compact('$categoryNews'));
    }

    public function submitEdit(Request $request){
        $categoryNews = $this->categoryNewsService->first(['id' => $request->id]);

        if (empty($brand)) {
            return redirect()->route('admin.$categoryNews.search')->with('error_message', 'Danh mục không tồn tại');
        }

        $data = $request->only('name', 'description');

        $this->categoryNewsService->edit($categoryNews, $data);

        return redirect()->route('admin.$categoryNews.search')->with('success_message', 'Sửa thành công');
    }

    public function delete(Request $request){
        $admin = $this->categoryNewsService->first(['id' => $request->id]);

        if (empty($admin)) {
            return response(['success'=>0, 'message'=>'Thương hiệu không tồn tại']);
        }

        $this->categoryNewsService->delete(['id' =>  $request->id]);

        return response(['success'=>1, 'message'=>'Xóa thành công']);
    }
}
