<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('khoas')->delete();

        DB::table('khoas')->truncate();

        DB::table('khoas')->insert([
            [
                'ten_khoa'          =>  'Công Nghệ Thông Tin',
                'so_dien_thoai'     =>  '84-05113-827111 (201)',
                'dia_chi'           =>  'K7/25 Quang Trung, Đà Nẵng',
                'email'             =>  'kcntt@duytan.edu.vn',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://kcntt.duytan.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Quản Trị Kinh Doanh',
                'so_dien_thoai'     =>  '0236.3650403 (128)',
                'dia_chi'           =>  'Phòng 201, 254 Nguyễn Văn Linh - Thanh Khê - Đà Nẵng',
                'email'             =>  'khoaquantrikinhdoanh@duytan.edu.vn',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://kqtkd.duytan.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Khách Sạn Nhà Hàng Quốc Tế',
                'so_dien_thoai'     =>  '0236.3650.403 (ext 301)',
                'dia_chi'           =>  'Phòng 301, Trường Du Lịch, Đại học Duy Tân, 254 Nguyễn Văn Linh, Q. Thanh Khê, Tp. Đà Nẵng',
                'email'             =>  'khoadulich@duytan.edu.vn ',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "http://dtu-hti.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Kế Toán',
                'so_dien_thoai'     =>  '1234567890',
                'dia_chi'           =>  'Phòng , 254 Nguyễn Văn Linh, Quận Thanh Khê - Tp. Đà Nẵng',
                'email'             =>  'kkt@duytan.edu.vn',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://kketoan.duytan.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Kinh Tế - Tài Chính',
                'so_dien_thoai'     =>  '(+84)2363.650403',
                'dia_chi'           =>  'Phòng 301, số 254 Nguyễn Văn Linh, P Thạc Gián, Q Thanh Khê, TP Đà Nẵng.',
                'email'             =>  'kkinhtetaichinh@duytan.edu.vn',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://kkttc.duytan.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Tiếng Hàn',
                'so_dien_thoai'     =>  '0236.3827111 – 101 (ext 223)',
                'dia_chi'           =>  'Phòng 223, 03 Quang Trung - Hải Châu - Đà Nẵng',
                'email'             =>  'khoatienghan@gmail.com',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://ktienghan.duytan.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Luật',
                'so_dien_thoai'     =>  '(0236) 3650403 (503)',
                'dia_chi'           =>  '254 Nguyễn Văn Linh, Quận Thanh Khê, Thành phố Đà Nẵng',
                'email'             =>  'khoaluatdtu@duytan.edu.vn',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://khoaluat.duytan.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Dược',
                'so_dien_thoai'     =>  '0236.3827.111 (ext 206)',
                'dia_chi'           =>  'Phòng 206, Khoa Dược, Đại Học Duy Tân, 03 Quang Trung, Q. Hải Châu, Tp. Đà Nẵng',
                'email'             =>  'khoaduocdtu@gmail.com',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://kduoc.duytan.edu.vn",
            ],
            [
                'ten_khoa'          =>  'Y',
                'so_dien_thoai'     =>  '0236.3827.111 (ext 216)',
                'dia_chi'           =>  'Phòng 216, Khoa Y, Đại Học Duy Tân, 03 Quang Trung, Q. Hải Châu, Tp. Đà Nẵng',
                'email'             =>  'masterhocdtu@gmail.com',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'link_website'      =>  "https://med.duytan.edu.vn",
            ],
        ]);
    }
}
