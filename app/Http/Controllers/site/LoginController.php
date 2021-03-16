<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\Register\RegisterRequest;


class LoginController extends Controller
{
    public function __construct()
    {
    }

    public function login(){
        return view('site.login.index');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth('customers')->attempt($credentials)) {
            return redirect()->intended(route('site.home.index'));
        }
        return back()->withInput()->with('error_login', 'Tài khoản hoặc mật khẩu không đúng');
    }

    public function logout(){
        auth('customers')->logout();
        //return redirect()->route('admin.login');
        return back();
    }

    public function register(Request $request){
        return view('site.register.index');
    }

    public function postRegister(RegisterRequest $request){
        dd($request->all());
    }
}
