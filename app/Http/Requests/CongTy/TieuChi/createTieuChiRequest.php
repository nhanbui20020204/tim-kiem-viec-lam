<?php

namespace App\Http\Requests\CongTy\TieuChi;

use Illuminate\Foundation\Http\FormRequest;

class createTieuChiRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tieu_de'               => 'required',
            'noi_dung_mo_ta'        => 'required',
            'tien_luong'            => 'required|numeric',
            'dia_chi_cong_viec'     => 'required',
            'ngay_bat_dau'          => 'required|date',
            'ngay_ket_thuc'         => 'required|date|after_or_equal:ngay_bat_dau',
            // 'id_skill'           => 'required|numeric',
            'is_open'               => 'required|boolean',
            'id_nganh'              => 'required|numeric',
            'so_luong'              => 'required|numeric',
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
            'boolean'                   =>  ':attribute chỉ được chọn Đang Hoạt Động / Không Hoạt Động',
            'same'                      =>  ':attribute không trùng',
            'digits'                    =>  ':attribute phải nhập 10 số',
            'date'                      =>  ':attribute phải chọn ngày',
            'after_or_equal'            =>  ':attribute lớn hơn Ngày Bắt Đầu',
            'is_open.required'          =>  'Vui lòng chọn Trạng Thái!',
            'id_nganh.required'         =>  'Vui lòng chọn Ngành!',
            // 'id_skill.required'      =>  'Vui lòng chọn Danh Mục!',

        ];
    }
    public function attributes()
    {
        return [
            'tieu_de'               => 'Tiêu Đề',
            'noi_dung_mo_ta'        => 'Mô Tả',
            'tien_luong'            => 'Tiền Lương',
            'dia_chi_cong_viec'     => 'Địa Chỉ',
            'ngay_bat_dau'          => 'Ngày Bắt Đầu',
            'ngay_ket_thuc'         => 'Ngày Kết Thúc',
            'id_skill'           => 'Danh Mục',
            'is_open'               => 'Trạng Thái',
            'id_nganh'              => 'Ngành',
            'so_luong'              => 'Số Lượng',
        ];
    }
}
