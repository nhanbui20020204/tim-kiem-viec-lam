<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateSkillRequest extends FormRequest
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
            'id'                    => 'exists:admins,id',
            'ten_skill'          => "required|min:2|max:30",
            'slug_skill'         => "required|min:1",
            'tinh_trang'            => "required",
        ];
    }

    public function messages()
    {
        return [
            'ten_skill.*'        => "Tên danh mục phải từ 2 đến 30 ký tự!",
            'slug_skill.*'       => "Slug danh mục phải từ 1 trở lên!",
            'tinh_trang.*'          => "Tình trạng chưa nhập!",
        ];
    }
}
