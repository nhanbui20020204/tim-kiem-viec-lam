<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('sinh_viens')->delete();

        DB::table('sinh_viens')->truncate();

        DB::table('sinh_viens')->insert([
            [
                'ten_sinh_vien'     => 'Lê Công Hậu',
                'email'             => 'leconghau2@dtu.edu.vn',
                'password'          => bcrypt(123456),
                'so_dien_thoai'     => '0965322638',
                'dia_chi'           => 'Xã Đại Quang, Huyện Đại Lộc, Tỉnh Quảng Nam',
                'id_khoa'           => 1,
                'mssv'              => '26211229580',
                'gioi_tinh'         => 1,
                'ngay_sinh'         => '2002/10/13',
                'id_nganh'          => 1,
                'mo_ta'             => 'Có kỉ năng yêu tuyệt đối',
                'lop_co_van'        => 'K26-TPM9',
                'is_active'         => 1,
            ],
            [
                'ten_sinh_vien'     => 'Nguyễn Đức Thắng',
                'email'             => 'nguyenducthang10@dtu.edu.vn',
                'password'          => bcrypt(123456),
                'so_dien_thoai'     => '0328392897',
                'dia_chi'           => 'Phường Hoà Thuận, TP.Tam Kỳ, Tỉnh Quảng Nam',
                'id_khoa'           => 1,
                'mssv'              => '26211200115',
                'gioi_tinh'         => 2,
                'ngay_sinh'         => '2002/10/13',
                'id_nganh'          => 1,
                'mo_ta'             => 'Thích làm chó',
                'lop_co_van'        => 'K26-TPM9',
                'is_active'         => 1,
            ],
            [
                'ten_sinh_vien'     => 'Trần Nhật Thiên',
                'email'             => 'trannhatthien@dtu.edu.vn',
                'password'          => bcrypt(123456),
                'so_dien_thoai'     => '0359781733',
                'dia_chi'           => 'Xã Đại Quang, Huyện Đại Lộc, Tỉnh Quảng Nam',
                'id_khoa'           => 1,
                'mssv'              => '26211232337',
                'gioi_tinh'         => 1,
                'ngay_sinh'         => '2002/01/13',
                'id_nganh'          => 1,
                'mo_ta'             => 'Tìm đối thủ',
                'lop_co_van'        => 'K26-TPM9',
                'is_active'         => 1,
            ],
            [
                'ten_sinh_vien'     => 'Trần Văn Quốc Bảo',
                'email'             => 'tranvquocbao@dtu.edu.vn',
                'password'          => bcrypt(123456),
                'so_dien_thoai'     => '0762590419',
                'dia_chi'           => 'Phường Điện Ngọc, Thị xã Điện Bàn, Tỉnh Quảng Nam',
                'id_khoa'           => 1,
                'mssv'              => '26211242366',
                'gioi_tinh'         => 1,
                'ngay_sinh'         => '2002/08/31',
                'id_nganh'          => 1,
                'mo_ta'             => 'Đảm đang',
                'lop_co_van'        => 'K26-TPM9',
                'is_active'         => 1,
            ],
            [
                'ten_sinh_vien'     => 'Bùi Đỗ Thanh Nhân',
                'email'             => 'buidthanhnhan@dtu.edu.vn',
                'password'          => bcrypt(123456),
                'so_dien_thoai'     => '0935070363',
                'dia_chi'           => 'Xã Cẩm Châu, TP.Hội An, Tỉnh Quảng Nam',
                'id_khoa'           => 1,
                'mssv'              => '26211226298',
                'gioi_tinh'         => 1,
                'ngay_sinh'         => '2002/04/02',
                'id_nganh'          => 2,
                'mo_ta'             => 'Thích độ xe',
                'lop_co_van'        => 'K26-TPM9',
                'is_active'         => 1,
            ],
        ]);
    }
}
