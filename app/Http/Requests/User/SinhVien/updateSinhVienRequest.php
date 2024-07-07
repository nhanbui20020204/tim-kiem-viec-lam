<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateSinhVienRequest extends FormRequest
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
            'id'                => 'exists:sinh_viens,id',
            'ten_sinh_vien'     => "required|min:2|max:20",
            'so_dien_thoai'     => "required|max:10",
            'email'             => "required|email|unique:sinh_viens,email," . $this->id,
            'password'          => "required|min:5",
            'dia_chi'           => "required|min:1",
            'id_khoa'           => "required|min:1",
            'mssv'              => "required|min:1",
            'gioi_tinh'         => "required",
            'ngay_sinh'         => "required|date",
        ];
    }

    public function messages()
    {
        return [
            'ten_sinh_vien.*'     => "Tên sinh viên phải từ 2 đến 20 ký tự!",
            'so_dien_thoai.*'     => "Số điện thoại phải là 10 số!",
            'dia_chi.*'           => "Địa chỉ phải từ 1 ký tự trở lên!",
            'email.required'      => "Email không được để trống!",
            'email.email'         => "Email không đúng định dạng!",
            'email.unique'        => "Email đã tồn tại!",
            'password.*'          => "Mật khẩu phải từ 1 trở lên!",
            'id_khoa.*'           => "Id khoa phải từ 1 kí tự trở lên!",
            'mssv.*'              => "Mssv phải từ 1 kí tự trở lên!",
            'gioi_tinh.*'         => "Giới tính chưa nhập!",
            'ngay_sinh.*'         => "Ngày sinh phải là định dạng ngày tháng",
        ];
    }
}
