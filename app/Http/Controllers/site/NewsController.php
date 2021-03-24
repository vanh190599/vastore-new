<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\CreateRequest;
use App\Library\CGlobal;
use App\Services\AdminService;
use App\Services\NewsService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewsController extends Controller{

    private $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $data = [];
        if (! empty($request->id)) {
            $data['conditions'][] = ['key'=>'category_news_id', 'value'=>$request->id];
        }
        $data['conditions'][] = ['key'=>'status', 'value'=>1];
        $data['limit'] = 10;
        $data['orderBy'] = 'id';
        $data['sortOrder'] = 'DESC';
        $news = $this->newsService->get($data);
        $news->load('cate');

        return view('site.news.index', compact('news'));
    }

    public function detail(Request $request){
        $new = $this->newsService->first(['id' => $request->id, 'status' => 1]);
        if (empty($new)) abort(404);

        return view('site.news.detail', compact('new'));
    }
}




