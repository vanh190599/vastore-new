<?php

namespace App\Http\Requests\Admin\Account;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'position' => 'required',
            'employee_id' => 'required|unique:mongodb.admin,employee_id',
            'email' => 'required|email|unique:mongodb.admin,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhân viên',
            'position.required' => 'Vui lòng nhập vị trí nhân viên',
            'email.required' => 'Vui lòng nhập email',
            'employee_id.required' => 'Vui lòng nhập mã nhân viên',
            'employee_id.unique' => 'Mã nhân viên đã tồn tại',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
        ];
    }
}
