<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCongTyRequest extends FormRequest
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
            'ten_cong_ty'        => "required|min:10|max:30",
            'slug_cong_ty'       => "required|min:10",
            'dia_chi'            => "required|min:10",
            'so_dien_thoai'      => "required|digits:10",
            'hinh_anh'           => "required",
            'email'              => "required|email",
            'mo_ta'              => "required|min:10",
        ];
    }

    public function messages()
    {
        return [
            'ten_cong_ty.*'         => "Tên công ty phải từ 10 đến 30 ký tự!",
            'slug_cong_ty.*'        => "Slug công ty phải !",
            'dia_chi.*'             => "Địa chỉ phải từ 10 ký tự trở lên!",
            'so_dien_thoai.'        => "Số điện thoại phải là 10 số!",
            'hinh_anh.*'            => "Hình ảnh không được bỏ trống!",
            'email.required'        => "Email không được để trống!",
            'email.email'           => "Email không đúng định dạng!",
            'mo_ta.*'               => "Mô tả phải nhiều hơn 10 kí tự!",
        ];
    }
}
