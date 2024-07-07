<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateNganhRequest extends FormRequest
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
            'ten_nganh'          => "required|min:2|max:30",
            'slug_nganh'         => "required|min:1",
            'id_khoa'            => "required|min:1",
            'is_open'            => "required",
        ];
    }

    public function messages()
    {
        return [
            'ten_nganh.*'        => "Tên Ngành phải từ 2 đến 30 ký tự!",
            'slug_nganh.*'       => "Slug Ngành phải từ 1 trở lên!",
            'id_khoa.*'          => "Id khoa phải từ 1 trở lên!",
            'is_open.*'          => "Tình trạng chưa nhập!",
        ];
    }
}
