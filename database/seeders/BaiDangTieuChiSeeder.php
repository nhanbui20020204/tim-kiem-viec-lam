<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaiDangTieuChiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bai_dang_tieu_chis')->delete();

        DB::table('bai_dang_tieu_chis')->truncate();

        DB::table('bai_dang_tieu_chis')->insert([
            [
                'tieu_de'               =>  'Tuyển Dụng Backend Developer',
                'noi_dung_mo_ta'        =>  'Nhanh nhẹn, trung thực, nhiện tình',
                'tien_luong'            =>  12000000,
                'dia_chi_cong_viec'     =>  '182-184 Đường 2/9, Phường Hòa Cường Bắc, Quận Hải Châu, Đà Nẵng',
                'ngay_bat_dau'          =>  '2024-01-01',
                'ngay_ket_thuc'         =>  '2024-01-15',
                'id_cong_ty'            =>  1,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  1,
                'so_luong'              =>  5,
                'diem_yeu_cau'          =>  7,
                'created_at'            => new \DateTime('2024/01/01 00:00:00'),
                'updated_at'            => new \DateTime('2024/01/01 00:00:00')
            ],
            [
                'tieu_de'               =>  'Tuyển Dụng Junior Java Developer',
                'noi_dung_mo_ta'        =>  'Giao tiếp tốt, hoà đồng, chăm chỉ, sáng tạo',
                'tien_luong'            =>  17000000,
                'dia_chi_cong_viec'     =>  'Trung tâm Kỹ thuật Phần mềm Đà Nẵng #1 214-216-218 Nguyễn Phước Lân, Đà Nẵng, Việt Nam',
                'ngay_bat_dau'          =>  '2024-02-14',
                'ngay_ket_thuc'         =>  '2024-03-05',
                'id_cong_ty'            =>  2,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  1,
                'so_luong'              =>  3,
                'diem_yeu_cau'          =>  8,
                'created_at'            => new \DateTime('2024/02/14 00:00:00'),
                'updated_at'            => new \DateTime('2024/02/14 00:00:00')
            ],
            [
                'tieu_de'               =>  'Tuyển Dụng AI Engineer',
                'noi_dung_mo_ta'        =>  'Tốt nghiệp Đại học các chuyên ngành Công nghệ thông tin, Khoa học máy tính, Điện tử viễn thông, Công nghệ phần mềm, Hệ thống thông tin...',
                'tien_luong'            =>  15000000,
                'dia_chi_cong_viec'     =>  '65 Hải Phòng, Thạch Thang, Hải Châu, Đà Nẵng',
                'ngay_bat_dau'          =>  '2024-03-07',
                'ngay_ket_thuc'         =>  '2024-03-22',
                'id_cong_ty'            =>  5,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  2,
                'so_luong'              =>  2,
                'diem_yeu_cau'          =>  9,
                'created_at'            => new \DateTime('2024/03/07 00:00:00'),
                'updated_at'            => new \DateTime('2024/03/07 00:00:00')
            ],
            [
                'tieu_de'               =>  'Tuyền Dụng PHP Developer',
                'noi_dung_mo_ta'        =>  'làm việc siêng năng, hòa đồng',
                'tien_luong'            =>  10000000,
                'dia_chi_cong_viec'     =>  'Tầng 11 Toà nhà Thông Tấn Xã Việt Nam, 81 Quang Trung, Q. Hải Châu, Đà Nẵng.',
                'ngay_bat_dau'          =>  '2024-04-10',
                'ngay_ket_thuc'         =>  '2024-04-25',
                'id_cong_ty'            =>  4,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  1,
                'so_luong'              =>  5,
                'diem_yeu_cau'          =>  8,
                'created_at'            => new \DateTime('2024/04/10 00:00:00'),
                'updated_at'            => new \DateTime('2024/04/10 00:00:00')
            ],
            [
                'tieu_de'               =>  'Tuyển Dụng NodeJS/NestJS Developer',
                'noi_dung_mo_ta'        =>  'Hoà động, khả năng tự học và giải quyết vấn đề tốt',
                'tien_luong'            =>  16000000,
                'dia_chi_cong_viec'     =>  '10 Hải Phòng, Thạch Thang, Hải Châu, Đà Nẵng',
                'ngay_bat_dau'          =>  '2024-04-05',
                'ngay_ket_thuc'         =>  '2024-04-25',
                'id_cong_ty'            =>  6,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  1,
                'so_luong'              =>  4,
                'diem_yeu_cau'          =>  8,
                'created_at'            => new \DateTime('2024/04/05 00:00:00'),
                'updated_at'            => new \DateTime('2024/04/05 00:00:00')
            ],
            [
                'tieu_de'               =>  'Tuyển Dụng Senior DevOps Engineer (Cloud, AWS, Azure)',
                'noi_dung_mo_ta'        =>  'Khả năng giải quyết vấn đề và xử lý sự cố xuất sắc, kỹ năng giao tiếp và cộng tác.',
                'tien_luong'            =>  18000000,
                'dia_chi_cong_viec'     =>  'Tầng 1 PVcomBank, 02 P. 30/4, đường Hải Châu, Đà Nẵng 550000',
                'ngay_bat_dau'          =>  '2024-04-05',
                'ngay_ket_thuc'         =>  '2024-04-25',
                'id_cong_ty'            =>  9,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  3,
                'so_luong'              =>  1,
                'diem_yeu_cau'          =>  7,
                'created_at'            => new \DateTime('2024/04/05 00:00:00'),
                'updated_at'            => new \DateTime('2024/04/05 00:00:00')
            ],
            [
                'tieu_de'               =>  'FullStack Developer (React, NodeJS)',
                'noi_dung_mo_ta'        =>  '● Chịu trách nhiệm nghiên cứu & phát triển các sản phẩm Web sử dụng ngôn ngữ/công nghệ: NodeJS, React/TypeScript, MySQL, Redis, Kafka, WebSocket, WebRTC, Elasticsearch,...<br>

                ● Xây dựng bộ JavaScript SDK voice/video call dựa trên WebRTC.<br>

                ● Xây dựng các plugin cho: Zendesk, Hubspot, Salesforce, Slack, Zoho,...<br>

                ● Tối ưu kiến trúc hệ thống, các ứng dụng Web cho hàng chục triệu người dùng thực tế.<br>',
                'tien_luong'            =>  20000000,
                'dia_chi_cong_viec'     =>  '466 Nguyễn Hữu Thọ, Khuê Trung, Cẩm Lệ, Đà Nẵng',
                'ngay_bat_dau'          =>  '2024-04-05',
                'ngay_ket_thuc'         =>  '2024-04-25',
                'id_cong_ty'            =>  8,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  1,
                'so_luong'              =>  1,
                'diem_yeu_cau'          =>  8,
                'created_at'            => new \DateTime('2024/04/05 00:00:00'),
                'updated_at'            => new \DateTime('2024/04/05 00:00:00')
            ],
            [
                'tieu_de'               =>  'Manual Tester - Nhân Viên Kiểm Thử Phần Mềm ',
                'noi_dung_mo_ta'        =>  '● Tham gia với đội dự án trong việc lấy yêu cầu của khách hàng; phân tích, thiết kế sản phẩm.<br>

                ● Lên kế hoạch kiểm thử sản phẩm, giải pháp phần mềm.<br>

                ● Xây dựng: Test design, Test scenarios, Test cases, Test script cho sản phẩm, giải pháp phần mềm.<br>

                ● Thực hiện kiểm thử chức năng, kiểm thử tích hợp, kiểm thử hệ thống, kiểm thử tự động và kiểm thử hiệu năng.<br>

                ● Tham gia thiết kế, xây dựng sản phẩm nhằm mang lại trải nghiệm tốt nhất cho người dùng.<br>

                ● Lập các báo cáo kiểm thử và Hướng dẫn sử dụng sản phẩm.<br>

                ● Tiếp nhận, phản hồi và kiểm soát việc sửa lỗi đảm bảo phần mềm đạt chất lượng.',
                'tien_luong'            =>  15000000,
                'dia_chi_cong_viec'     =>  '182-184 Nguyễn Tri Phương, Thạc Gián, Thanh Khê, Đà Nẵng',
                'ngay_bat_dau'          =>  '2024-04-05',
                'ngay_ket_thuc'         =>  '2024-04-25',
                'id_cong_ty'            =>  3,
                'is_open'               =>  1,
                'is_duyet'              =>  1,
                'id_nganh'              =>  1,
                'so_luong'              =>  1,
                'diem_yeu_cau'          =>  8,
                'created_at'            => new \DateTime('2024/04/05 00:00:00'),
                'updated_at'            => new \DateTime('2024/04/05 00:00:00')
            ],
        ]);
    }
}
