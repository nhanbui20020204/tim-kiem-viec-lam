<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BangDiem extends Model
{
    use HasFactory;

    protected $table = 'bang_diems';
    protected $fillable = [
        'ma_mon',
        'ten_mon',
        'diem_so',
        'diem_chu',
        'hinh_anh',
        'id_sinh_vien',
        'is_duyet',
    ];
}
