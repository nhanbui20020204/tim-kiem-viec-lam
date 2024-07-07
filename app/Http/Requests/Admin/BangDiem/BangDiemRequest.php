<?php

namespace App\Http\Requests\Admin\BangDiem;

use Illuminate\Foundation\Http\FormRequest;

class BangDiemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ma_mon'            => "required|min:2|max:10",
            'ten_mon'           => "required|min:5|max:50",
            'diem_so'          => "required|numeric|between:0,10",
            'diem_chu'          => "required|in:A,B,C,D,F",
        ];
    }

    public function messages()
    {
        return [
            'ma_mon.*'            => "Mã môn phải từ 2 kí tự trở lên",
            'ten_mon.*'           => "Tên môn phải từ 5 kí tự trở lên",
            'diem_so.required'    => "Điểm số không được để trống",
            'diem_so.numberic'    => "Điểm số phải là số",
            'diem_so.between'     => "Điểm số phải là số lớn hơn 0 nhỏ hơn 10",
            'diem_chu.required'   => "Điểm chữ không được để trống",
            'diem_chu.in'         => "Điểm chữ phải là A, B, C, D hoặc F",
        ];
    }
    public function attributes()
    {
        return [
            'ma_mon'            => 'Mã môn',
            'ten_mon'           => 'Tên Môn',
            'diem_so'          => 'Điểm Số',
            'diem_chu'          => 'Điểm Chữ',
            // 'id_sinh_vien'          => 'Sinh Viên',
            // 'is_duyet'          => 'Duyệt',
        ];
    }
}
