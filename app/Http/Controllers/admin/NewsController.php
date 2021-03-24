<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\BrandRequest;
use App\Library\CGlobal;
use App\Services\CategoryNewsService;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller{

    private $newsService;
    private $categoryNewsService;

    public function __construct(NewsService $newsService, CategoryNewsService $categoryNewsService)
    {
        $this->newsService = $newsService;
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

        $news = $this->newsService->search($data);
        $news->load('cate');

        return view('admin.news.search',
            compact(
                'news',
                'aryStatus'
            )
        );
    }

    public function create(){
        $cate = $this->categoryNewsService->get([]);
        $aryStatus = CGlobal::$aryStatusActive;
        return view('admin.news.create', compact('aryStatus', 'cate'));
    }

    public function submitCreate(Request $request){
        $user = auth('admin')->user();
        $data = $request->only('title', 'description', 'content', 'image', 'category_news_id');
        $data['user_name_c'] = $user->name;
        $data['user_id_c'] = $user->id;
        $data['date_c'] = time();

        $news = $this->newsService->create($data);
        return redirect()->route('admin.news.search')->with('success_message', 'Tạo thành công');
    }

    public function edit(Request $request){
        $cate = $this->categoryNewsService->get([]);
        $aryStatus = CGlobal::$aryStatusShow;
        $news = $this->newsService->first(['id' => $request->id]);
        if (empty($news)) {
            return redirect()->route('admin.news.search')->with('error_message', 'Danh mục không tồn tại');
        }

        return view('admin.news.edit', compact('aryStatus', 'cate'))->with('news', $news);
    }

    public function submitEdit(Request $request){
        $news = $this->newsService->first(['id' => $request->id]);

        if (empty($news)) {
            return redirect()->route('admin.news.search')->with('error_message', 'Danh mục không tồn tại');
        }

        $data = $request->only('title', 'description', 'content', 'image', 'status', 'category_news_id');

        $this->newsService->edit($news, $data);

        return redirect()->route('admin.news.search')->with('success_message', 'Sửa thành công');
    }

    public function delete(Request $request){
        $cate = $this->newsService->first(['id' => $request->id]);

        if (empty($cate)) {
            return response(['success'=>0, 'message'=>'Danh mục không tồn tại']);
        }

        $this->newsService->delete(['id' =>  $request->id]);

        return response(['success'=>1, 'message'=>'Xóa thành công']);
    }
}
