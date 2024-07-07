<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVienUngTuyen extends Model
{
    use HasFactory;
    protected $table = 'sinh_vien_ung_tuyens';
    protected $fillable = [
        'id_sinh_vien',
        'id_tieu_chi',
        'tinh_trang',
    ];
}
