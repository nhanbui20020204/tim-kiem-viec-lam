<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateDanhgiaRequest extends FormRequest
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
            'ten_cong_ty'        => "required|min:2|max:30",
            'ten_khoa'          => "required|min:1",
            'ten_nganh'          => "required|min:2|max:30",
            'id_sinh_vien'           => "required",
            'mo_ta'                            => "required|min:10",

            'mo_ta'                            => "required|min:10",
        ];
    }
    public function messages()
    {
        return [
            'ten_cong_ty.*'         => "Tên công ty phải từ 2 đến 30 ký tự!",
            'ten_khoa.*'          => "Tên khoa phải từ 1 đến 20 ký tự!",
            'ten_nganh.*'        => "Tên Ngành phải từ 2 đến 30 ký tự!",
            'id_sinh_vien.*'           => "Vui lòng chọn khoa!",
            'mo_ta.*'                   => "Nội dung mô tả không được để trống!",
        ];
    }
}
