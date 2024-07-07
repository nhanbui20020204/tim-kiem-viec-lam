<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    use HasFactory;
    protected $table = 'nganhs';

    protected $fillable = [
        'ten_nganh',
        'slug_nganh',
        'id_khoa',
        'is_open',
    ];
}
