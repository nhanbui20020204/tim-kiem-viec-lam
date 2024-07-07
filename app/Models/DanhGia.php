<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'danh_gias';
    protected $fillable = [
        'id_cong_ty',
        'id_sinh_vien',
        'mo_ta',
        'so_sao',
        'is_duyet',

    ];
}
