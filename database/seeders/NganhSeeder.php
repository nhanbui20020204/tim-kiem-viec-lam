<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NganhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('nganhs')->delete();

        DB::table('nganhs')->truncate();

        DB::table('nganhs')->insert([
            [
                'ten_nganh'     => 'CÔNG NGHỆ PHẦN MỀM',
                'slug_nganh'    =>  Str::slug('CÔNG NGHỆ PHẦN MỀM'),
                'id_khoa'       =>  1,
                'is_open'       =>  1,
            ],
            [
                'ten_nganh'     => 'TRÍ TUỆ NHÂN TẠO',
                'slug_nganh'    => Str::slug('TRÍ TUỆ NHÂN TẠO'),
                'id_khoa'       => 1,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'KĨ THUẬT PHẦN MỀM',
                'slug_nganh'    => Str::slug('KĨ THUẬT PHẦN MỀM'),
                'id_khoa'       => 1,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'QUẢN TRỊ KINH DOANH TỔNG HỢP',
                'slug_nganh'    => Str::slug('QUẢN TRỊ KINH DOANH TỔNG HỢP'),
                'id_khoa'       => 2,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'QUẢN TRỊ MARKETING',
                'slug_nganh'    => Str::slug('QUẢN TRỊ MARKETING'),
                'id_khoa'       => 2,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'KINH DOANH THƯƠNG MẠI',
                'slug_nganh'    => Str::slug('KINH DOANH THƯƠNG MẠI'),
                'id_khoa'       => 2,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'QUẢN TRỊ KHÁCH SẠN QUỐC TẾ',
                'slug_nganh'    => Str::slug('QUẢN TRỊ KHÁCH SẠN QUỐC TẾ'),
                'id_khoa'       => 3,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'QUẢN TRỊ DU LỊCH & KHÁCH SẠN',
                'slug_nganh'    => Str::slug('QUẢN TRỊ DU LỊCH & KHÁCH SẠN'),
                'id_khoa'       => 3,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'KẾ TOÁN KIỂM TOÁN',
                'slug_nganh'    => Str::slug('KẾ TOÁN KIỂM TOÁN'),
                'id_khoa'       => 4,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'KẾ TOÁN DOANH NGHIỆP',
                'slug_nganh'    => Str::slug('KẾ TOÁN DOANH NGHIỆP'),
                'id_khoa'       => 4,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'TÀI CHÍNH DOANH NGHIỆP',
                'slug_nganh'    => Str::slug('TÀI CHÍNH DOANH NGHIỆP'),
                'id_khoa'       => 5,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'NGÂN HÀNG',
                'slug_nganh'    => Str::slug('NGÂN HÀNG'),
                'id_khoa'       => 5,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'LOGICTICS VÀ QUẢN LÝ CUNG CỨNG',
                'slug_nganh'    => Str::slug('LOGICTICS VÀ QUẢN LÝ CUNG CỨNG'),
                'id_khoa'       => 5,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'QUẢN TRỊ TÀI CHÍNH (HP)',
                'slug_nganh'    => Str::slug('QUẢN TRỊ TÀI CHÍNH (HP)'),
                'id_khoa'       => 5,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'TIẾNG HÀN DU LỊCH',
                'slug_nganh'    => Str::slug('TIẾNG HÀN DU LỊCH'),
                'id_khoa'       => 6,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'TIẾNG HÀN BIÊN - PHIÊN DỊCH',
                'slug_nganh'    => Str::slug('TIẾNG HÀN BIÊN - PHIÊN DỊCH'),
                'id_khoa'       => 6,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'LUẬT KINH TẾ',
                'slug_nganh'    => Str::slug('LUẬT KINH TẾ'),
                'id_khoa'       => 7,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'LUẬT KINH DOANH',
                'slug_nganh'    => Str::slug('LUẬT KINH DOANH'),
                'id_khoa'       => 7,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'DƯỢC (DƯỢC SĨ ĐẠI HỌC)',
                'slug_nganh'    => Str::slug('DƯỢC (DƯỢC SĨ ĐẠI HỌC)'),
                'id_khoa'       => 8,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'CÔNG NGHỆ SINH HỌC',
                'slug_nganh'    => Str::slug('CÔNG NGHỆ SINH HỌC'),
                'id_khoa'       => 8,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'BÁC SĨ ĐA KHOA',
                'slug_nganh'    => Str::slug('BÁC SĨ ĐA KHOA'),
                'id_khoa'       => 9,
                'is_open'       => 1,
            ],
            [
                'ten_nganh'     => 'QUẢN LÝ BỆNH VIỆN',
                'slug_nganh'    => Str::slug('QUẢN LÝ BỆNH VIỆN'),
                'id_khoa'       => 9,
                'is_open'       => 1,
            ],
        ]);
    }
}
