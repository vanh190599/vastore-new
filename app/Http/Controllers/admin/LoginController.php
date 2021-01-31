<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\CGlobal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    public function __construct()
    {
    }

    public function login(){
        return view('admin.login.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth('admin')->attempt($credentials)) {
            // Authentication passed...
            CGlobal::$_USER = auth('admin')->user();

            //dd(CGlobal::$_USER);
            View::share('admin', auth('admin')->user());
            return redirect()->intended(route('admin.dashboard.index'));
        }
        return back()->withInput()->with('error_login', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('admin.login');
    }
}
