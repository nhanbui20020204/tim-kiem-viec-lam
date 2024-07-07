<?php

namespace App\Http\Requests\CongTy\Profile;

use Illuminate\Foundation\Http\FormRequest;

class updatePorfileTieuChiRequest extends FormRequest
{
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
            'so_dien_thoai'      => "required|digits:10",
            'email'              => "required|email|unique:cong_ties,email," . $this->id,
            'fax'                => "required|min:1",
            'mo_ta'              => "nullable|min:10",
        ];
    }

    public function messages()
    {
        return [
            'ten_cong_ty.*'         => "Tên công ty phải từ 2 đến 30 ký tự!",
            'slug_cong_ty.*'        => "Slug công ty phải !",
            'dia_chi.*'             => "Địa chỉ phải từ 1 ký tự trở lên!",
            'so_dien_thoai.*'       => "Số điện thoại phải là 10 số!",
            'email.required'        => "Email không được để trống!",
            'email.email'           => "Email không đúng định dạng!",
            'email.unique'          => "Email đã tồn tại!",
            'fax.*'                 => "Fax không được để trống!",
            'mo_ta.*'               => "Mô tả phải nhiều hơn 1 kí tự!",
        ];
    }
}
