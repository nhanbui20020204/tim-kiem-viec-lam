<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->delete();

        DB::table('skills')->truncate();

        DB::table('skills')->insert([
            [
                'ten_skill'     => 'TOEIC 500+',
                'slug_skill'    =>  Str::slug('TOEIC 500+'),
                'tinh_trang'    =>  1,
            ],
            [
                'ten_skill'     => 'TOEIC 700+',
                'slug_skill'    =>  Str::slug('TOEIC 700+'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'TOEIC 900+',
                'slug_skill'    =>  Str::slug('TOEIC 900+'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Thành thạo Tin học văn phòng',
                'slug_skill'    =>  Str::slug('Thành thạo Tin học văn phòng'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Tiếng Anh giao tiếp tốt',
                'slug_skill'    =>  Str::slug('Tiếng Anh giao tiếp tốt'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Có kinh nghiệm về các Framework liên quan',
                'slug_skill'    =>  Str::slug('Có kinh nghiệm về các Framework liên quan'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Thành thạo ngôn ngữ Java',
                'slug_skill'    =>  Str::slug('Thành thạo ngôn ngữ Java'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Thành thạo ngôn ngữ NodeJS',
                'slug_skill'    =>  Str::slug('Thành thạo ngôn ngữ NodeJS'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Thành thạo ngôn ngữ PHP',
                'slug_skill'    =>  Str::slug('Thành thạo ngôn ngữ PHP'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Thành thạo một trong các ngôn ngữ(Java, NodeJS, PHP, C#,...)',
                'slug_skill'    =>  Str::slug('Thành thạo một trong các ngôn ngữ(Java, NodeJS, PHP, C#,...)'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Thành thạo ngôn ngữ Python',
                'slug_skill'    =>  Str::slug('Thành thạo ngôn ngữ Python'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Có kinh nghiệm làm việc với Docker',
                'slug_skill'    =>  Str::slug('Có kinh nghiệm làm việc với Docker'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Khả năng tự học hỏi và làm việc nhóm',
                'slug_skill'    =>  Str::slug('Khả năng tự học hỏi và làm việc nhóm'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Có tư duy giải quyết vấn đề độc lập',
                'slug_skill'    =>  Str::slug('Có tư duy giải quyết vấn đề độc lập'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Hiểu biết về  cấu trúc dữ liệu và thuật toán',
                'slug_skill'    =>  Str::slug('Hiểu biết về  cấu trúc dữ liệu và thuật toán'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Có kiến thức về OOP',
                'slug_skill'    =>  Str::slug('Có kiến thức về OOP'),
                'tinh_trang'    =>  1,

            ],
            [
                'ten_skill'     => 'Có kinh nghiệm làm việc với Cloud, AWS,...',
                'slug_skill'    =>  Str::slug('Có kinh nghiệm làm việc với Cloud, AWS,...'),
                'tinh_trang'    =>  1,
            ],
            [
                'ten_skill'     => 'Thành thạo ReactJS',
                'slug_skill'    =>  Str::slug('Thành thạo ReactJS'),
                'tinh_trang'    =>  1,
            ],
            [
                'ten_skill'     => 'Thành thạo VueJS',
                'slug_skill'    =>  Str::slug('Thành thạo VueJS'),
                'tinh_trang'    =>  1,
            ],
            [
                'ten_skill'     => 'Có kinh nghiệm về kiểm thử phần mềm',
                'slug_skill'    =>  Str::slug('Có kinh nghiệm về kiểm thử phần mềm'),
                'tinh_trang'    =>  1,
            ],
            [
                'ten_skill'     => 'Kinh nghiệm làm việc với các công cụ CI/CD',
                'slug_skill'    =>  Str::slug('Kinh nghiệm làm việc với các công cụ CI/CD'),
                'tinh_trang'    =>  1,
            ],
        ]);
    }
}
