<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class CongTy extends Authenticatable
{
    use HasFactory;

    protected $table = 'cong_ties';
    protected $fillable = [
        'ten_cong_ty',
        'slug_cong_ty',
        'dia_chi',
        'so_dien_thoai',
        'hinh_anh',
        'email',
        'mo_ta',
        'website',
        'password',
        'is_active',
        'hash_active'
    ];
}
