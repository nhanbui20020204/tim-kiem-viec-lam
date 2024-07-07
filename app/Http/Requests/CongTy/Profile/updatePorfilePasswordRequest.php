<?php

namespace App\Http\Requests\CongTy\Profile;

use Illuminate\Foundation\Http\FormRequest;

class updatePorfilePasswordRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'password'      => 'required|min:6|max:30',
            're_password'   => 'required|same:password'
        ];
    }
    public function messages()
    {
        return [
            'required'  => ':attribute không được để trống',
            'min'       => ':attribute quá ngắn',
            'max'       => ':attribute quá dài',
            'same'      => ':attribute không trùng',

        ];
    }
    public function attributes()
    {
        return [
            'password'      => 'Mật Khẩu',
            're_password'   => 'Nhập Lại Mật Khẩu'
        ];
    }
}
