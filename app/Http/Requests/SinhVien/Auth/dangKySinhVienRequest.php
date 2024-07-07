<?php

namespace App\Http\Requests\SinhVien\Auth;

use Illuminate\Foundation\Http\FormRequest;

class dangKySinhVienRequest extends FormRequest
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
            'ten_sinh_vien'         => 'required|min:5',
            'email'                 => 'required|email|unique:sinh_viens,email',
            'password'              => 'required|min:6|max:30',
            're_password'           => 'required|same:password',
            'so_dien_thoai'         => 'required|digits:10|unique:sinh_viens,so_dien_thoai',
            'dia_chi'               => 'required|min:5',
            'id_khoa'               => 'required',
            'mssv'                  => 'required|min:5|unique:sinh_viens,mssv',
            'gioi_tinh'             => 'required|boolean',
            'ngay_sinh'             => 'required|date',
            'mo_ta'                 => 'nullable|min:10',
            'lop_co_van'            => 'required|min:5',
            'id_nganh'              => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required'                  =>  ':attribute không được để trống!',
            'unique'                    =>  ':attribute đã tồn tại trong hệ thống',
            'min'                       =>  ':attribute quá nhỏ/ngắn',
            'max'                       =>  ':attribute quá lớn/dài',
            'numeric'                   =>  ':attribute phải là số',
            'boolean'                   =>  ':attribute chỉ được chọn Đã / Chưa',
            'same'                      =>  ':attribute không trùng',
            'digits'                    =>  ':attribute phải nhập 10 số',
            'email.email'               =>  'Email đúng định dạng',
            'id_khoa.required'          =>  'Vui lòng chọn khoa',
            'gioi_tinh.required'        =>  'Vui lòng chọn giới tính',
            'gioi_tinh.boolean'         =>  'Chỉ được chọn Nam/Nữ',
            'ngay_sinh.required'        =>  'Vui lòng chọn ngày sinh',
            'id_nganh.required'         =>  'Vui lòng chọn ngành',



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
