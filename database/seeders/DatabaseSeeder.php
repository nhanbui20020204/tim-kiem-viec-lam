<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Action;
use App\Models\BangDiem;
use App\Models\CongTy;
use App\Models\MailLienHe;
use App\Models\SkillSinhVien;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminSeeder::class,
            BangDiemSeeder::class,
            CongTySeeder::class,
            BaiDangTieuChiSeeder::class,
            SkillSeeder::class,
            KhoaSeeder::class,
            NganhSeeder::class,
            SinhVienSeeder::class,
            ActionSeeder::class,
            QuyenSeeder::class,
            SkillTieuChiSeeder::class,
            SkillSinhVienSeeder::class,
            MailLienHeSeeder::class,
        ]);
    }
}
