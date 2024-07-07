<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillTieuChiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skill_tieu_chis')->delete();

        DB::table('skill_tieu_chis')->truncate();

        DB::table('skill_tieu_chis')->insert([
            [
                'id_tieu_chi'   =>  1,
                'id_skill'      =>  1,
            ],
            [
                'id_tieu_chi'   =>  1,
                'id_skill'      =>  5,
            ],
            [
                'id_tieu_chi'   =>  1,
                'id_skill'      =>  10,
            ],
            [
                'id_tieu_chi'   =>  2,
                'id_skill'      =>  7,
            ],
            [
                'id_tieu_chi'   =>  2,
                'id_skill'      =>  12,
            ],
            [
                'id_tieu_chi'   =>  2,
                'id_skill'      =>  15,
            ],
            [
                'id_tieu_chi'   =>  3,
                'id_skill'      =>  11,
            ],
            [
                'id_tieu_chi'   =>  3,
                'id_skill'      =>  14,
            ],
            [
                'id_tieu_chi'   =>  3,
                'id_skill'      =>  2,
            ],
            [
                'id_tieu_chi'   =>  4,
                'id_skill'      =>  9,
            ],
            [
                'id_tieu_chi'   =>  4,
                'id_skill'      =>  16,
            ],
            [
                'id_tieu_chi'   =>  4,
                'id_skill'      =>  2,
            ],
            [
                'id_tieu_chi'   =>  5,
                'id_skill'      =>  8,
            ],
            [
                'id_tieu_chi'   =>  5,
                'id_skill'      =>  6,
            ],
            [
                'id_tieu_chi'   =>  5,
                'id_skill'      =>  12,
            ],
            [
                'id_tieu_chi'   =>  5,
                'id_skill'      =>  5,
            ],
            [
                'id_tieu_chi'   =>  6,
                'id_skill'      =>  11,
            ],
            [
                'id_tieu_chi'   =>  6,
                'id_skill'      =>  17,
            ],
            [
                'id_tieu_chi'   =>  6,
                'id_skill'      =>  21,
            ],
            [
                'id_tieu_chi'   =>  7,
                'id_skill'      =>  8,
            ],
            [
                'id_tieu_chi'   =>  7,
                'id_skill'      =>  7,
            ],
            [
                'id_tieu_chi'   =>  7,
                'id_skill'      =>  16,
            ],
            [
                'id_tieu_chi'   =>  7,
                'id_skill'      =>  18,
            ],
            [
                'id_tieu_chi'   =>  8,
                'id_skill'      =>  20,
            ],
            [
                'id_tieu_chi'   =>  8,
                'id_skill'      =>  15,
            ],
            [
                'id_tieu_chi'   =>  8,
                'id_skill'      =>  2,
            ],
        ]);
    }
}
