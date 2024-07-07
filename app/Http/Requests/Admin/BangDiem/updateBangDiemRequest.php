<?php

namespace App\Http\Requests\Admin\BangDiem;

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
            'ma_mon'            => 'required|min:3',
            'ten_mon'           => 'required|min:3',
            'diem_so'          => 'required|numeric|min:1',
            'diem_chu'          => 'required|min:1',
            'id_sinh_vien'      => 'required',
            'is_duyet'          => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'required'                  =>  ':attribute không được để trống!',
            'is_duyet.required'         =>  'Vui lòng chọn Duyệt',
            'id_sinh_vien.required'     =>  'Vui lòng chọn Sinh Viên',
            'unique'                    =>  ':attribute đã tồn tại trong hệ thống',
            'min'                       =>  ':attribute quá nhỏ/ngắn',
            'max'                       =>  ':attribute quá lớn/dài',
            'numeric'                   =>  ':attribute phải là số',
            'boolean'                   =>  ':attribute chỉ được chọn Đã / Chưa',
        ];
    }
    public function attributes()
    {
        return [
            'ma_mon'            => 'Mã môn',
            'ten_mon'           => 'Tên Môn',
            'diem_so'          => 'Điểm Số',
            'diem_chu'          => 'Điểm Chữ',
            'id_sinh_vien'          => 'Sinh Viên',
            'is_duyet'          => 'Duyệt',
        ];
    }
}
