<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiDangTieuChi extends Model
{
    use HasFactory;
    protected $table = 'bai_dang_tieu_chis';

    protected $fillable = [
        'tieu_de',
        'noi_dung_mo_ta',
        'tien_luong',
        'dia_chi_cong_viec',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'id_cong_ty',
        'id_skill',
        'is_open',
        'is_duyet',
        'id_nganh',
        'so_luong',
        'diem_yeu_cau',
    ];
}
