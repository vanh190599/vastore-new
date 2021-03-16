<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Integer;

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
            "name" => 'required',
            'brand' => 'required',
            "price" => 'required',
            //"price_discount" => 'required',
            "unit_num" => 'required',
            "unit_label" => 'required',
            "release_date" => 'required',
            "height" => 'required' ,
            "width" => 'required',
            "depth" => 'required',
            "tech_screen" => 'required',
            "size" => 'required',
            "cpu" => 'required',
            "ram" => 'required',
            "rom" => 'required',
            "battery_capacity" => 'required',
            "camera_before" => 'required',
            "camera_after" => 'required',
            "description" => 'required',
            "image" => 'required',
            "status" => 'required',
            //"attach" => 'required',
            //"attach_image" => 'required',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => 'Vui lòng nhập tên sản phẩm',
            'brand.required' => 'Vui lòng chọn thương hiệu',
            "price.required" => 'Vui lòng nhập giá',
            //"price_discount" => 'required',
            "unit_num.required" => 'Vui lòng nhập thời gian bảo hành',
            "unit_label.required" => 'Vui lòng chọn thời gian',
            //"release_date.required" => '',
            "height.required" => 'Vui lòng nhập chiều cao' ,
            //"height.float" => 'Chiều cao không hợp lệ' ,
            "width.required" => 'Vui lòng nhập chiều rộng',
            //"width.float" => 'Chiều rộng không hợp lệ',
            "depth.required" => 'Vui lòng nhập độ dày',
            //"depth.float" => 'Độ dày không hợp lệ',
            "tech_screen.required" => 'Vui lòng nhập công nghệ màn hình',
            "size.required" => 'Vui lòng nhập kích thước màn hình',
            //"size.float" => 'Kích thước màn hình không hợp lệ',
            "cpu.required" => 'Vui lòng nhập cpu',
            "ram.required" => 'Vui lòng nhập ram',
            "rom.required" => 'Vui lòng nhập dung lượng',
            "battery_capacity.required" => 'Vui lòng nhập dung lượng pin',
            "camera_before.required" => 'Vui lòng nhập camera trước',
            //"camera_before.integer" => 'Dữ liệu không hợp lệ',
            "camera_after.required" => 'Vui lòng nhập camera sau',
            //"camera_after.integer" => 'Dữ liệu không hợp lệ',
            "description.required" => 'Vui lòng nhập mô tả',
            "image.required" => 'Vui lòng chọn ảnh',
            "release_date.required" => 'Vui lòng chọn ngày ra mắt',
            //"status" => 'required',
        ];
    }
}
