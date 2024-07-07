<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quyens')->delete();

        DB::table('quyens')->truncate();
        DB::table('quyens')->insert([
            'ten_quyen'     =>'Quản Lý',
            'slug'      => Str::slug('Quản Lý'),
            'list_rule'     => '1',
            'is_open'       =>1,
        ]);

    }
}
