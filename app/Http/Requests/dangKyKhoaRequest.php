<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class dangKyKhoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'ten_khoa'         => 'required|min:5',
            'email'                 => 'required|email|unique:sinh_viens,email',
            'password'              => 'required|min:6|max:30',
            're_password'           => 'required|same:password',
            'so_dien_thoai'         => 'required|digits:10|unique:sinh_viens,so_dien_thoai',
            'dia_chi'               => 'required|min:5',
            // 'is_block'              => 'required|'  ,
            // 'congty_id'               => 'required',


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
            // 'congty_id.required'        =>  'Vui lòng chọn Công ty',

            // 'is_block.*'                =>  'Yêu cầu trạng thái không được bỏ trống!',



        ];
    }
    public function attributes()
    {
        return [
            'ten_khoa'     => 'Tên Sinh Viên',
            'email'     => 'Email',
            'password'      => 'Password',
            'so_dien_thoai'     => 'Số Điện Thoại',
            'dia_chi'       => 'Địa Chỉ',
            'congty_id' => 'Công Ty',
            're_password'   => 'Nhập Lại Mật Khẩu'
        ];
    }
}
