<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillSinhVien extends Model
{
    use HasFactory;
    protected $table = 'skill_sinh_viens';

    protected $fillable = [
        'id_skill',
        'id_sinh_vien',
    ];
}
