<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\OrderDetailService;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    private $orderDetailService;
    public function __construct(OrderDetailService $orderDetailService)
    {
        $this->orderDetailService = $orderDetailService;
    }

    public function index(){
        return view('admin.dashboard.index');
    }

    public function test(){
        return view('admin.layout.test');
    }

    public function twd(){
        return view('twd.index');
    }

    public function chart(Request $request){
        $type = $request->type;
        $data = [];
        switch ($type) {
            case "day":
                $data = $this->orderDetailService->chartByDay();
                break;
            case "month":
                $data = $this->orderDetailService->chartByMonth();
                break;
            default:
                break;
        }
        return response(['success' => 1, 'data' => $data]);
    }
}
