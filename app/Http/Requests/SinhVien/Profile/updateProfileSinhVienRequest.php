<?php

namespace App\Http\Requests\SinhVien\Profile;

use Illuminate\Foundation\Http\FormRequest;

class updateProfileSinhVienRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_sinh_vien'     => "required|min:2|max:20",
            'so_dien_thoai'     => "required|max:10",
            'email'             => "required|email|unique:sinh_viens,email," . $this->id,
            'dia_chi'           => "required|min:1",
            'mssv'              => "required|min:1",
            'gioi_tinh'         => "required",
            'lop_co_van'         => "required",
            'ngay_sinh'         => "required|date",
        ];
    }

    public function messages()
    {
        return [
            'ten_sinh_vien.*'     => "Tên sinh viên phải từ 2 đến 20 ký tự!",
            'lop_co_van.*'        => "Lớp cố vấn không được để trống!",
            'so_dien_thoai.*'     => "Số điện thoại phải là 10 số!",
            'dia_chi.*'           => "Địa chỉ phải từ 1 ký tự trở lên!",
            'email.required'      => "Email không được để trống!",
            'email.email'         => "Email không đúng định dạng!",
            'email.unique'        => "Email đã tồn tại!",
            'password.*'          => "Mật khẩu phải từ 1 trở lên!",
            'mssv.*'              => "Mssv phải từ 1 kí tự trở lên!",
            'gioi_tinh.*'         => "Giới tính chưa nhập!",
            'ngay_sinh.*'         => "Ngày sinh phải là định dạng ngày tháng",
        ];
    }
    public function attributes()
    {
        return [
            'ten_sinh_vien' => 'Tên Sinh Viên',
            'mssv'          => 'Mã Số Sinh Viên',
            'so_dien_thoai' => 'Số Điện Thoại',
            'email'         => 'Email',
            'id_khoa'       => 'Khoa',
            'id_nganh'      => 'Ngành',
            'gioi_tinh'     => 'Giới Tính',
            'lop_co_van'    => 'Lớp Cố Vấn',
            'dia_chi'       => 'Địa Chỉ',
            'ngay_sinh'     => 'Ngày Sinh',
            'password'      => 'Password',
            're_password'   => 'Nhập Lại Mật Khẩu',
            'mo_ta'         => 'Mô tả',
        ];
    }
}
