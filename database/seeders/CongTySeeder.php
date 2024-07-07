<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CongTySeeder extends Seeder
{

    public function run(): void
    {
        DB::table('cong_ties')->delete();

        DB::table('cong_ties')->truncate();

        DB::table('cong_ties')->insert([
            [
                'ten_cong_ty'       =>  'Công ty FPT Software Đà Nẵng',
                'slug_cong_ty'      => Str::slug('Công ty FPT Software Đà Nẵng'),
                'dia_chi'           =>  '182-184 Đường 2/9, Phường Hòa Cường Bắc, Quận Hải Châu, Đà Nẵng',
                'so_dien_thoai'     =>  '0935884368',
                'hinh_anh'          =>  'https://fpt.com/-/media/project/fpt-corporation/fpt/about-us/general-introduction/two-cols-text-with-image-intro/logo-fpt.png',
                'email'             =>  'fptsortware@fpt.com',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'Môi trường làm việc hiện đại, thân thiện, và đầy đủ tiện nghi là điểm nhấn của FPT Software Đà Nẵng.',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://fpt.com/vi',

            ],
            [
                'ten_cong_ty'       =>  'Công ty phần mềm Enclave',
                'slug_cong_ty'      => Str::slug('Công ty phần mềm Enclave'),
                'dia_chi'           =>  'Trung tâm Kỹ thuật Phần mềm Đà Nẵng #1 214-216-218 Nguyễn Phước Lân, Đà Nẵng, Việt Nam',
                'so_dien_thoai'     =>  '+84 (236) 625 3000',
                'hinh_anh'          =>  'https://www.enclave.vn/wp-content/uploads/2019/08/ver-01.png',
                'email'             =>  'jobs@enclave.vn',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'Enclave có mối quan hệ chặt chẽ với nhiều tổ chức giáo dục, đặc biệt là Đại học Duy Tân, nơi họ tổ chức các buổi hội thảo, workshop, và cung cấp học bổng cũng như cơ hội thực tập cho sinh viên. Công ty cũng được biết đến là một trong những môi trường làm việc tốt nhất tại Việt Nam, với một tỷ lệ cao các kỹ sư nữ và các phương pháp quản lý nhân sự sáng tạo',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'www.enclave.vn',

            ],
            [
                'ten_cong_ty'       =>  'Công ty BAP Software',
                'slug_cong_ty'      => Str::slug('Công ty BAP Software'),
                'dia_chi'           =>  '182-184 Nguyễn Tri Phương, Thạc Gián, Thanh Khê, Đà Nẵng',
                'so_dien_thoai'     =>  '0236 6565 115',
                'hinh_anh'          =>  'https://cdn-new.topcv.vn/unsafe/140x/filters:format(webp)/https://static.topcv.vn/company_logos/040rDz8kC3SIohtZ0B3UAQzUArMK38Lv_1650443373____b6d4cd54c1d3ca8226dd0d981cdfbfb2.png',
                'email'             =>  'recruit@bap.jp',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'BAP Software là một công ty phần mềm. Họ chuyên về phát triển phần mềm tùy chỉnh và giải pháp phần mềm cho các doanh nghiệp trên toàn cầu.',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://bap-software.net',

            ],
            [
                'ten_cong_ty'       =>  'Công Ty RikkeiSoft',
                'slug_cong_ty'      => Str::slug('Công Ty RikkeiSoft'),
                'dia_chi'           =>  'Tầng 11 Toà nhà Thông Tấn Xã Việt Nam, 81 Quang Trung, Q. Hải Châu, Đà Nẵng.',
                'so_dien_thoai'     =>  '(+84) 23 696 268 5',
                'hinh_anh'          =>  'https://tuyendung.rikkeisoft.com/assets/front/images/logoRikkeisoft.png',
                'email'             =>  'tuyendung.dn@rikkeisoft.com',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'Rikkeisoft là một công ty phần mềm và dịch vụ công nghệ thông tin có trụ sở tại Việt Nam. Công ty đã phát triển trong lĩnh vực phần mềm tùy biến, phát triển ứng dụng di động, phát triển phần mềm doanh nghiệp và nhiều dịch vụ khác.',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://rikkeisoft.com',

            ],
            [
                'ten_cong_ty'       =>  'Công ty CMC Global Đà Nẵng',
                'slug_cong_ty'      =>  Str::slug('Công ty CMC Global Đà Nẵng'),
                'dia_chi'           =>  '65 Hải Phòng, Thạch Thang, Hải Châu, Đà Nẵng',
                'so_dien_thoai'     =>  '03283928971',
                'hinh_anh'          =>  'https://www.cmc.com.vn/main/imgs/logo.svg',
                'email'             =>  'tuyendung.dn@cmcsoftware.com',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'Tập đoàn Công nghệ CMC là tập đoàn số toàn cầu, đẳng cấp quốc tế.  CMC đã khẳng định vị thế trên thị trường Việt Nam và nhiều nước trên thế giới thông qua những hoạt động kinh doanh chủ lực ở 4 khối: Khối Hạ tầng số, Khối Công nghệ & Giải pháp, Khối Kinh doanh Quốc tế, Khối Nghiên cứu và Giáo dục',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://www.cmc.com.vn',

            ],
            [
                'ten_cong_ty'       =>  'Công ty D-Soft Đà Nẵng',
                'slug_cong_ty'      => Str::slug('Công ty D-Soft Đà Nẵng'),
                'dia_chi'           =>  '10 Hải Phòng, Thạch Thang, Hải Châu, Đà Nẵng',
                'so_dien_thoai'     =>  '0236 3866 796',
                'hinh_anh'          =>  'https://d-soft.com.vn/wp-content/uploads/2020/11/logo.svg',
                'email'             =>  'info@d-soft.com.vn',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'D-Soft là công ty phát triển phần mềm có trụ sở chính tại Đà Nẵng, Việt Nam, chúng tôi cung cấp các dịch vụ kỹ thuật phần mềm chất lượng cao và các giải pháp tối ưu thực tế nhất tập trung vào AI (trí tuệ nhân tạo), big data, nghiên cứu và phát triển deep tech.',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://d-soft.com.vn',

            ],
            [
                'ten_cong_ty'       =>  'Công ty DataHouse Asia',
                'slug_cong_ty'      => Str::slug('Công ty DataHouse Asia'),
                'dia_chi'           =>  'Đ. 2 Tháng 9, Hoà Cường Bắc, Hải Châu, Đà Nẵng',
                'so_dien_thoai'     =>  '0777 876 588',
                'hinh_anh'          =>  'https://www.datahouse.com/wp-content/uploads/2019/06/Logo@2x-1.png',
                'email'             =>  'info@datahouse.com',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'DataHouse Asia cũng thường tham gia vào các dự án phát triển phần mềm toàn diện, từ việc thiết kế và triển khai đến việc hỗ trợ và bảo trì sau khi triển khai. Công ty này được biết đến với sự chuyên nghiệp và chất lượng trong dịch vụ của mình, cùng với khả năng tư vấn và cung cấp các giải pháp phù hợp với nhu cầu của khách hàng.',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://www.datahouse.com/',

            ],
            [
                'ten_cong_ty'       =>  'Công ty Cổ phần Phần mềm BRAVO',
                'slug_cong_ty'      => Str::slug('Công ty Cổ phần Phần mềm BRAVO'),
                'dia_chi'           =>  '466 Nguyễn Hữu Thọ, Khuê Trung, Cẩm Lệ, Đà Nẵng',
                'so_dien_thoai'     =>  '0236 3633 733',
                'hinh_anh'          =>  'https://www.bravo.com.vn/wp-content/uploads/2022/09/Logo.svg',
                'email'             =>  'tuyendungdn@bravo.com.vn',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'Công ty này tập trung vào việc phát triển các ứng dụng phần mềm doanh nghiệp, ứng dụng di động, và các giải pháp phần mềm khác để giúp khách hàng tối ưu hóa quản lý, tăng cường hiệu suất làm việc và cải thiện trải nghiệm của người dùng.',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://www.bravo.com.vn/',

            ],
            [
                'ten_cong_ty'       =>  'Công ty Axon Active',
                'slug_cong_ty'      => Str::slug('Công ty Axon Active'),
                'dia_chi'           =>  'Tầng 1 PVcomBank, 02 P. 30/4, đường Hải Châu, Đà Nẵng 550000',
                'so_dien_thoai'     =>  '028 7109 1234',
                'hinh_anh'          =>  'https://cdn-new.topcv.vn/unsafe/140x/filters:format(webp)/https://static.topcv.vn/company_logos/b6a9197abf1fb50d875a1aa78ce6baea-61480a5153262.jpg',
                'email'             =>  'info@axonactive.com',
                // 'fax'               =>  '1',
                'mo_ta'             =>  'Axon Active đã xây dựng một mô hình phát triển phần mềm linh hoạt, sử dụng Agile và Scrum, để đảm bảo rằng họ có thể phản ứng nhanh chóng và linh hoạt đối với yêu cầu thay đổi từ khách hàng. Công ty này chủ yếu hoạt động trong lĩnh vực phát triển phần mềm tùy chỉnh cho các ứng dụng di động, web và desktop, cũng như các giải pháp phần mềm doanh nghiệp.',
                'password'          =>  bcrypt(123456),
                'is_active'         =>  1,
                'website'           =>  'https://www.axonactive.com',

            ],

        ]);
    }
}
