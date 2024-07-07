<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateBangDiemRequest extends FormRequest
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
            'diem_so'          => "required|numeric|between:0,10",
            'diem_chu'          => "required|in:A,B,C,D,F",
        ];
    }

    public function messages()
    {
        return [
            'ma_mon.*'            => "Mã môn phải từ 2 kí tự trở lên",
            'ten_mon.*'           => "Tên môn phải từ 2 kí tự trở lên",
            'diem_so.required'    => "Điểm số không được để trống",
            'diem_so.numberic'    => "Điểm số phải là số",
            'diem_so.between'     => "Điểm số phải là số lớn hơn 0 nhỏ hơn 10",
            'diem_chu.required'   => "Điểm chữ không được để trống",
            'diem_chu.in'         => "Điểm chữ phải là A, B, C, D hoặc F",
        ];
    }
}
