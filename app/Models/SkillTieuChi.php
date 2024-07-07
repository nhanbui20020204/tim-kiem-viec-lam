<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillTieuChi extends Model
{
    use HasFactory;
    protected $table = "skill_tieu_chis";
    protected $fillable = [
        'id_tieu_chi',
        'id_skill',
    ];
}
