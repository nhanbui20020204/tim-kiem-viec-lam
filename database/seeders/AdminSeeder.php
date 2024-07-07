<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->delete();

        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
                'ho_va_ten'         =>  'Admin',
                'email'             =>  'admin@admin.com',
                'password'          =>  bcrypt(123456),
                'so_dien_thoai'     =>  '0328392897',
                'is_active'           =>  1,
                'id_quyen'          =>  0,
                'is_master'         =>  1,
            ],
            [
                'ho_va_ten'         =>  'Other Admin',
                'email'             =>  '123@gmail.com',
                'password'          =>  bcrypt(123456),
                'so_dien_thoai'     =>  '0328392894',
                'is_active'           =>  1,
                'id_quyen'          =>  '1',
                'is_master'         =>  0,
            ],
        ]);
    }
}
