<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class createBangDiemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ma_mon'            => "required|min:2|max:30",
            'ten_mon'           => "required|min:2|max:50",
            'diem_goc'          => "required",
            'diem_chu'          => "required",
        ];
    }
    public function messages()
    {
        return [
            'ma_mon.*'            => "Phải nhập vào mã môn",
            'ten_mon.*'           => "Phải nhập vào tên môn",
            'diem_goc.*'          => "Phải nhập vào điểm gốc",
            'diem_chu.*'          => "Phải nhập vào điểm chữ",
        ];
    }
}
