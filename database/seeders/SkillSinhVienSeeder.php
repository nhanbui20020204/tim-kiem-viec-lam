<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skill_sinh_viens')->delete();

        DB::table('skill_sinh_viens')->truncate();

        DB::table('skill_sinh_viens')->insert([
            [
                'id_skill'      => 1,
                'id_sinh_vien'  => 1
            ],
            [
                'id_skill'      => 4,
                'id_sinh_vien'  => 1
            ],
            [
                'id_skill'      => 9,
                'id_sinh_vien'  => 1
            ],
            [
                'id_skill'      => 6,
                'id_sinh_vien'  => 1
            ],
            [
                'id_skill'      => 1,
                'id_sinh_vien'  => 2
            ],
            [
                'id_skill'      => 9,
                'id_sinh_vien'  => 2
            ],
            [
                'id_skill'      => 4,
                'id_sinh_vien'  => 2
            ],
            [
                'id_skill'      => 6,
                'id_sinh_vien'  => 2
            ],
            [
                'id_skill'      => 1,
                'id_sinh_vien'  => 3
            ],
            [
                'id_skill'      => 9,
                'id_sinh_vien'  => 3
            ],
            [
                'id_skill'      => 4,
                'id_sinh_vien'  => 3
            ],
            [
                'id_skill'      => 6,
                'id_sinh_vien'  => 3
            ],
            [
                'id_skill'      => 8,
                'id_sinh_vien'  => 4
            ],
            [
                'id_skill'      => 1,
                'id_sinh_vien'  => 4
            ],
            [
                'id_skill'      => 6,
                'id_sinh_vien'  => 4
            ],
            [
                'id_skill'      => 18,
                'id_sinh_vien'  => 4
            ],
            [
                'id_skill'      => 1,
                'id_sinh_vien'  => 4
            ],
            [
                'id_skill'      => 4,
                'id_sinh_vien'  => 4
            ],
            [
                'id_skill'      => 6,
                'id_sinh_vien'  => 4
            ],
            [
                'id_skill'      => 1,
                'id_sinh_vien'  => 5
            ],
            [
                'id_skill'      => 4,
                'id_sinh_vien'  => 5
            ],
            [
                'id_skill'      => 6,
                'id_sinh_vien'  => 5
            ],
            [
                'id_skill'      => 9,
                'id_sinh_vien'  => 5
            ],
        ]);
    }
}
