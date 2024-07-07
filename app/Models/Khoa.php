<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Khoa extends Authenticatable
{
    use HasFactory;
    protected $table = 'khoas';

    protected $fillable = [
        'ten_khoa',
        'so_dien_thoai',
        'dia_chi',
        'email',
        'password',
        'link_website',
        'is_active',
        'hash_active',
    ];
}
