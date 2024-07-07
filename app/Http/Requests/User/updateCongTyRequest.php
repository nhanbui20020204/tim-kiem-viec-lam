<?php

namespace App\Http\Requests\User;

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
            'id'                 => 'exists:cong_ties,id',
            'ten_cong_ty'        => "required|min:2|max:30",
            'slug_cong_ty'       => "required|min:1",
            'dia_chi'            => "required|min:1",
            'so_dien_thoai'      => "required|max:10",
            'hinh_anh'           => "required",
            'email'              => "required|email|unique:cong_ties,email," . $this->id,
            'fax'                => "required|min:1",
            'mo_ta'              => "required|min:10",
            'password'          => "required|min:3",
            'is_open'            => "required",
        ];
    }

    public function messages()
    {
        return [
            'ten_cong_ty.*'         => "Tên công ty phải từ 2 đến 30 ký tự!",
            'slug_cong_ty.*'        => "Slug công ty phải !",
            'dia_chi.*'             => "Địa chỉ phải từ 1 ký tự trở lên!",
            'so_dien_thoai.*'       => "Số điện thoại phải là 10 số!",
            'hinh_anh.*'            => "Hình ảnh không được bỏ trống!",
            'email.required'        => "Email không được để trống!",
            'email.email'           => "Email không đúng định dạng!",
            'email.unique'          => "Email đã tồn tại!",
            'fax.*'                 => "Fax không được để trống!",
            'mo_ta.*'               => "Mô tả phải nhiều hơn 1 kí tự!",
            'password.*'           => "Mật khẩu phải từ 3 ký tự trở lên!",
            'is_open.*'             => "Tình trạng chưa nhập!",
        ];
    }
}
