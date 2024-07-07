<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeSinhVienKhoaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_sinh_vien'     => "required|min:2|max:20",
            'so_dien_thoai'     => "required|digits:10|unique:sinh_viens,so_dien_thoai",
            'email'             => "required|email|unique:sinh_viens,email",
            'password'          => "required|min:5",
            'dia_chi'           => "required|min:1",
            'mssv'              => "required|min:1",
            'gioi_tinh'         => "required|boolean",
            'ngay_sinh'         => "required|date",
            'lop_co_van'        => "required|min:2",
        ];
    }

    public function messages()
    {
        return [
            'ten_sinh_vien.*'       => "Tên sinh viên phải từ 2 đến 20 ký tự!",
            'so_dien_thoai.*'       => "Số điện thoại phải là 10 số!",
            'so_dien_thoai.unique'  => "Số điện thoại đã tồn tại!",
            'dia_chi.*'           => "Địa chỉ phải từ 1 ký tự trở lên!",
            'email.required'      => "Email không được để trống!",
            'email.email'         => "Email không đúng định dạng!",
            'email.unique'        => "Email đã tồn tại!",
            'password.*'          => "Mật khẩu phải từ 1 trở lên!",
            'mssv.*'              => "Mã số sinh viên phải từ 1 kí tự trở lên!",
            'gioi_tinh.*'         => "Vui lòng chọn giới tính!",
            'gioi_tinh.required'  => "Phải trên 18 tuổi!",
            'ngay_sinh.*'         => "Vui lòng chọn ngày sinh!",
            'ngay_sinh.date'      => "Vui lòng chọn ngày sinh đúng định dạng!",
            'lop_co_van.min'      => "Lớp cố vấn quá ngắn!",
            'lop_co_van.required' => "Lớp cố vấn không được để trống!",
        ];
    }
}
