<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVienDatYeuCau extends Model
{
    use HasFactory;
    protected $table = 'sinh_vien_dat_yeu_caus';
    protected $fillable = [
        'id_tieu_chi',
        'id_sinh_vien',
        'id_khoa',
        'is_chon',
    ];
}
