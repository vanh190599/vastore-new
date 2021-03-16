<?php

namespace App\Http\Requests\Site\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password'=>"required|min:6",
            'cf_password'=>"required|same:password",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên quản trị viên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',

            'password.required'=>"Vui lòng nhập mật khẩu mới!",
            'password.min'=>"Vui lòng nhập mật ít nhất 8 ký tự!",
            'cf_password.required'=>"Vui lòng nhập xác nhận mật khẩu!",
            'cf_password.same'=>"Mật khẩu không khớp!",
        ];
    }
}
