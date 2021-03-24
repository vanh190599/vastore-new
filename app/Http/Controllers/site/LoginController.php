<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Http\Requests\Site\Register\RegisterRequest;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    private $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
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
        $data = $request->only('name', 'email', 'password');
        $data['password'] = Hash::make($data['password']);
        $this->customerService->create($data);

        return redirect()->route('site.login')->with('success', 'Đăng kí thành công');
    }
}
