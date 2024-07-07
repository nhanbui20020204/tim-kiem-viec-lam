<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    public function run()
    {
        DB::table('actions')->delete();

        DB::table('actions')->truncate();

        DB::table('actions')->insert([

            ['id' => 1, 'ten_action' => 'Xem Admin'],
            ['id' => 2, 'ten_action' => 'Thêm mới Admin'],
            ['id' => 3, 'ten_action' => 'Đổi trạng thái Admin'],
            ['id' => 4, 'ten_action' => 'Xóa Admin'],
            ['id' => 5, 'ten_action' => 'Cập nhật Admin'],
            ['id' => 17, 'ten_action' => 'Đổi Mật Khẩu Admin'],

            ['id' => 6, 'ten_action' => 'Xem Khoa'],
            ['id' => 7, 'ten_action' => 'Thêm mới Khoa'],
            ['id' => 8, 'ten_action' => 'Xóa Khoa'],
            ['id' => 9, 'ten_action' => 'Đổi trạng thái Khoa'],
            ['id' => 10, 'ten_action' => 'Cập nhật Khoa'],
            ['id' => 11, 'ten_action' => 'Tìm kiếm Khoa'],

            ['id' => 12, 'ten_action' => 'Xem Bảng Điểm'],
            ['id' => 13, 'ten_action' => 'Thêm mới Bảng Điểm'],
            ['id' => 14, 'ten_action' => 'Xóa Bảng Điểm'],
            ['id' => 15, 'ten_action' => 'Duyệt Bảng Điểm'],
            ['id' => 16, 'ten_action' => 'Cập nhật Bảng Điểm'],
            // ['id' => 17, 'ten_action' => 'Duyệt Bảng Điểm'],

            ['id' => 18, 'ten_action' => 'Xem Công Ty'],
            ['id' => 19, 'ten_action' => 'Thêm mới Công Ty'],
            ['id' => 20, 'ten_action' => 'Xóa Công Ty'],
            ['id' => 21, 'ten_action' => 'Đổi trạng thái Công Ty'],
            ['id' => 22, 'ten_action' => 'Cập nhật Công Ty'],


            ['id' => 23, 'ten_action' => 'Xem Tiêu Chí'],
            ['id' => 24, 'ten_action' => 'Thêm mới Tiêu Chí'],
            ['id' => 25, 'ten_action' => 'Xóa Tiêu Chí'],
            ['id' => 26, 'ten_action' => 'Đổi trạng thái Tiêu Chí'],
            ['id' => 27, 'ten_action' => 'Cập nhật Tiêu Chí'],
            ['id' => 28, 'ten_action' => 'Duyệt Tiêu Chí'],

            ['id' => 29, 'ten_action' => 'Xem Sinh Viên'],
            ['id' => 30, 'ten_action' => 'Thêm mới Sinh Viên'],
            ['id' => 31, 'ten_action' => 'Xóa Sinh Viên'],
            ['id' => 32, 'ten_action' => 'Đổi trạng thái Sinh Viên'],
            ['id' => 33, 'ten_action' => 'Cập nhật Sinh Viên'],
            ['id' => 34, 'ten_action' => 'Đổi mật khẩu Sinh Viên'],


            ['id' => 35, 'ten_action' => 'Xem Ngành'],
            ['id' => 36, 'ten_action' => 'Thêm mới Ngành'],
            ['id' => 37, 'ten_action' => 'Xóa Ngành'],
            ['id' => 38, 'ten_action' => 'Đổi trạng thái Ngành'],
            ['id' => 39, 'ten_action' => 'Cập nhật Ngành'],

            ['id' => 100, 'ten_action' => 'Xem phân quyền'],
            ['id' => 101, 'ten_action' => 'Thêm mới phân quyền'],
            ['id' => 102, 'ten_action' => 'Đổi trạng thái phân quyền'],
            // ['id' => 103, 'ten_action' => 'Cấp phân quyền'],
            ['id' => 104, 'ten_action' => 'Chỉnh sửa phân quyền'],
            ['id' => 105, 'ten_action' => 'Xóa phân quyền'],
            ['id' => 106, 'ten_action' => 'Cập nhật phân quyền'],
        ]);
    }
}
