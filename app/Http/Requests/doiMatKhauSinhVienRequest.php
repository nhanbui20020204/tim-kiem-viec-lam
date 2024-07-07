<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class doiMatKhauSinhVienRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'new_password'         => 'required|min:6|max:30',

        ];
    }
    public function messages()
    {
        return [
            'required'      =>  ':attribute không được để trống!',
            'unique'        =>  ':attribute đã tồn tại trong hệ thống',
            'min'           =>  ':attribute quá nhỏ/ngắn',
            'max'           =>  ':attribute quá lớn/dài',
            'numeric'       =>  ':attribute phải là số',
        ];
    }
    public function attributes()
    {
        return [
            'new_password'         => 'Mật khẩu',
        ];
    }
}
