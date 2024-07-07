<?php

namespace App\Http\Requests\CongTy\Auth;

use Illuminate\Foundation\Http\FormRequest;

class dangKyCongTyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_cong_ty'       => 'required|min:5',
            'slug_cong_ty'      => 'required|min:5',
            'dia_chi'           => 'required|min:5',
            'so_dien_thoai'     => 'required|digits:10|unique:cong_ties,so_dien_thoai',
            'hinh_anh'          => 'required',
            'email'             => 'required|email|unique:cong_ties,email',
            'fax'               => 'nullable|min:10',
            'mo_ta'             => 'required|min:20',
            'password'          => 'required|min:6|max:30',
            're_password'       => 'required|same:password',

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
            'between'                   =>  ':attribute chỉ được tối đa 10 đến 11 số'
        ];
    }
    public function attributes()
    {
        return [
            'ten_cong_ty'               => 'Tên Công Ty',
            'slug_cong_ty'              => 'Slug Công Ty',
            'dia_chi'                   => 'Địa Chỉ',
            'so_dien_thoai'             => 'Số Điện Thoại',
            'hinh_anh'                  => 'Hình Ảnh',
            'email'                     => 'Email',
            'fax'                       => 'Fax',
            'mo_ta'                     => 'Mô Tả',
            'password'                  => 'Mật Khẩu',
            're_password'               => 'Nhập Lại Mật Khẩu',
        ];
    }
}
