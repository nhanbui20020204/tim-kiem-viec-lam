<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailLienHeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mail_lien_hes')->delete();

        DB::table('mail_lien_hes')->truncate();

        DB::table('mail_lien_hes')->insert([
            [
                'id_sinh_vien'      =>  1,
                'id_tieu_chi'       =>  1,
                'id_cong_ty'        =>  1,
                'noi_dung'          =>  'Mời bạn đến công ty để làm bài Test nhanh và phỏng vấn',
                'thoi_gian'         =>  '15h30 ngày 05/02/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/02/05 00:00:00'),
                'updated_at'        => new \DateTime('2024/02/05 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  2,
                'id_tieu_chi'       =>  2,
                'id_cong_ty'        =>  2,
                'noi_dung'          =>  'Mời bạn đến công ty để làm bài Test và phỏng vấn 30p',
                'thoi_gian'         =>  '9h00 ngày 07/03/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/03/07 00:00:00'),
                'updated_at'        => new \DateTime('2024/03/07 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  3,
                'id_tieu_chi'       =>  2,
                'id_cong_ty'        =>  2,
                'noi_dung'          =>  'Mời bạn đến công ty để làm bài Test và phỏng vấn',
                'thoi_gian'         =>  '15h30 ngày 05/02/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/03/07 00:00:00'),
                'updated_at'        => new \DateTime('2024/03/07 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  4,
                'id_tieu_chi'       =>  3,
                'id_cong_ty'        =>  5,
                'noi_dung'          =>  'Mời bạn đến công ty để làm bài Test nhanh và phỏng vấn',
                'thoi_gian'         =>  '14h00 ngày 24/03/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/03/24 00:00:00'),
                'updated_at'        => new \DateTime('2024/03/24 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  5,
                'id_tieu_chi'       =>  4,
                'id_cong_ty'        =>  4,
                'noi_dung'          =>  'Mời bạn đến công ty để làm bài Test nhanh 20 phút và phỏng vấn',
                'thoi_gian'         =>  '8h30 ngày 28/04/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/04/28 00:00:00'),
                'updated_at'        => new \DateTime('2024/04/28 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  4,
                'id_tieu_chi'       =>  5,
                'id_cong_ty'        =>  6,
                'noi_dung'          =>  'Mời bạn đến công ty để làm bài Test Thuật toán và phỏng vấn nhanh',
                'thoi_gian'         =>  '8h30 ngày 28/04/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/04/28 00:00:00'),
                'updated_at'        => new \DateTime('2024/04/28 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  1,
                'id_tieu_chi'       =>  6,
                'id_cong_ty'        =>  9,
                'noi_dung'          =>  'Mời bạn đến công ty để phỏng vấn',
                'thoi_gian'         =>  '9h30 ngày 28/04/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/04/28 00:00:00'),
                'updated_at'        => new \DateTime('2024/04/28 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  4,
                'id_tieu_chi'       =>  7,
                'id_cong_ty'        =>  8,
                'noi_dung'          =>  'Mời bạn đến công ty để phỏng vấn 30p',
                'thoi_gian'         =>  '8h30 ngày 28/04/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/04/28 00:00:00'),
                'updated_at'        => new \DateTime('2024/04/28 15:00:00')
            ],
            [
                'id_sinh_vien'      =>  5,
                'id_tieu_chi'       =>  8,
                'id_cong_ty'        =>  3,
                'noi_dung'          =>  'Mời bạn đến công ty để phỏng vấn',
                'thoi_gian'         =>  '8h30 ngày 28/04/2024',
                'is_accept'         =>  -1,
                'tinh_trang'        =>  1,
                'created_at'        => new \DateTime('2024/04/28 00:00:00'),
                'updated_at'        => new \DateTime('2024/04/28 15:00:00')
            ],
        ]);
    }
}
