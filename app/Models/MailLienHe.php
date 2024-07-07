<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLienHe extends Model
{
    use HasFactory;
    protected $table = 'mail_lien_hes';

    protected $fillable = [
        'id_sinh_vien',
        'id_tieu_chi',
        'id_cong_ty',
        'noi_dung',
        'is_accept',
        'thoi_gian',
        'tinh_trang',
    ];
}
