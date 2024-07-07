<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SinhVien extends Authenticatable
{
    use HasFactory;

    protected $table = 'sinh_viens';

    protected $fillable = [
        'ten_sinh_vien',
        'email',
        'password',
        'so_dien_thoai',
        'dia_chi',
        'id_khoa',
        'mssv',
        'gioi_tinh',
        'ngay_sinh',
        'mo_ta',
        'lop_co_van',
        'id_nganh',
        'is_active',
        'hash_active',
    ];
}
