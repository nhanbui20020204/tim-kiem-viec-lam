<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateKhoaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_khoa'          => "required|min:8",
            'so_dien_thoai'     => "required|numeric|digits:10",
            'dia_chi'           => "required|min:10",
            'email'             => "required|email",
            'password'          => "required|min:6",
        ];
    }

    public function messages()
    {
        return [
            'ten_khoa.*'          => "Tên khoa phải từ 8 đến 20 ký tự!",
            'so_dien_thoai.*'     => "Số điện thoại phải là 10 số!",
            'dia_chi.*'           => "Địa chỉ phải từ 10 ký tự trở lên!",
            'email.required'      => "Email không được để trống!",
            'email.email'         => "Email không đúng định dạng!",
            'password.*'          => "Mật khẩu phải từ 6 kí tự trở lên!",
        ];
    }
}
