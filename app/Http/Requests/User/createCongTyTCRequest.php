<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class createCongTyTCRequest extends FormRequest
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
            'noi_dung_mo_ta'        => "required",
            'tien_luong'            => "required|numeric",
            'dia_chi_cong_viec'     => "require",
            'ngay_bat_dau'          => "required|date",
            'ngay_ket_thuc'         => "required|date",
            // 'id_cong_ty'            => "required|integer",
            // 'id_skill'           => "required|integer",
            'is_open'               => "required|boolean",
            // 'is_duyet'              => "required|boolean",
            'id_nganh'              => "required|integer",
            'so_luong'              => "required|integer",
            'tieu_de'               => "required",
        ];
    }

    public function messages()
    {
        return [
            'tieu_de.*'             => "Tiêu đề phải từ 2 đến 255 ký tự!",
            'tien_luong.*'          => "Tiền lương phải là số!",
            'dia_chi_cong_viec.*'   => "Địa chỉ công việc không được vượt quá 255 ký tự!",
            'ngay_bat_dau.*'        => "Ngày bắt đầu không hợp lệ!",
            'ngay_ket_thuc.*'       => "Ngày kết thúc không hợp lệ!",
            // 'id_cong_ty.*'          => "ID công ty phải là số nguyên!",
            // 'id_skill.*'         => "ID danh mục phải là số nguyên!",
            'is_open.*'             => "Trường is_open phải là boolean!",
            // 'is_duyet.*'            => "Trường is_duyet phải là boolean!",
            'id_nganh.*'            => "ID ngành phải là số nguyên!",
            'so_luong.*'            => "Số lượng phải là số nguyên!",
            'noi_dung_mo_ta.*'      => "Nội dung mô tả không được để trống!",

        ];
    }
}
