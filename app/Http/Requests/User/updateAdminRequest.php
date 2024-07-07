<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ho_va_ten'             => "required|min:2|max:30",
            'so_dien_thoai'         => "required|digits:10",
            'email'                 => "required|email|unique:admins,email," . $this->id,
            'id_quyen'              => "required|min:1",
            'password'              => "required|min:6",
            'is_active'             => "required",
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.*'           => "Họ và tên phải từ 2 đến 30 ký tự!",
            'so_dien_thoai.*'       => "Số điện thoại phải là 10 số!",
            'email.required'        => "Email không được để trống!",
            'email.email'           => "Email không đúng định dạng!",
            'email.unique'          => "Email đã tồn tại!",
            'id_quyen.*'            => "Vui lòng chọn quyền!",
            'password.*'            => "Mật khẩu phải từ 5 ký tự trở lên!",
            'is_active.*'             => "Vui lòng chọn tình trạng!",
        ];
    }
}
