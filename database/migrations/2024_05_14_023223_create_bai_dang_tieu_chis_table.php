<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bai_dang_tieu_chis', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->longText('noi_dung_mo_ta');
            $table->integer('tien_luong');
            $table->string('dia_chi_cong_viec');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->integer('id_cong_ty')->nullable();
            $table->integer('is_open')->default(1);
            $table->integer('is_duyet')->default(0);
            $table->integer('id_nganh')->nullable();
            $table->integer('so_luong')->nullable();
            $table->double('diem_yeu_cau')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_dang_tieu_chis');
    }
};
