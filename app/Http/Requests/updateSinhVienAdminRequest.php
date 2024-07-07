<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateSinhVienAdminRequest extends FormRequest
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
            'ten_sinh_vien'     => "required|min:6|max:30",
            'so_dien_thoai'     => "required|numeric|digits:10",
            'email'             => "required|email",
            'password'          => "required|min:5",
            'dia_chi'           => "required|min:6",
            'id_khoa'           => "required",
            'mssv'              => "required|numeric|digits:11",
            'gioi_tinh'         => "required|boolean",
            'ngay_sinh'         => "required|date",
            'lop_co_van'        => "nullable|min:2",
        ];
    }

    public function messages()
    {
        return [
            'ten_sinh_vien.*'     => "Tên sinh viên phải từ 6 đến 30 ký tự!",
            'so_dien_thoai.*'     => "Số điện thoại phải là 10 số!",
            'dia_chi.*'           => "Địa chỉ phải từ 6 ký tự trở lên!",
            'email.required'      => "Email không được để trống!",
            'email.email'         => "Email không đúng định dạng!",
            'password.*'          => "Mật khẩu phải từ 1 trở lên!",
            'id_khoa.*'           => "Vui lòng chọn khoa!",
            'mssv.digits'         => "Mã số sinh viên phải là 11 số!",
            'gioi_tinh.*'         => "Vui lòng chọn giới tính!",
            'ngay_sinh.*'         => "Vui lòng chọn ngày sinh!",
            'ngay_sinh.date'      => "Vui lòng chọn ngày sinh đúng định dạng!",
            'lop_co_van.min'      => "Lớp cố vấn quá ngắn!",
        ];
    }
}
