<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __construct()
    {
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
}
