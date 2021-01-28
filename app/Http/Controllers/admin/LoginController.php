<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            //return redirect()->intended(route('dashboard'));
            dd(1);
        }
        dd(2);
        //return back()->withInput()->with('error_login', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
