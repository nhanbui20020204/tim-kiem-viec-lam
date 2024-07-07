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
        Schema::create('sinh_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ten_sinh_vien');
            $table->string('email');
            $table->string('password');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->integer('id_khoa');
            $table->string('mssv');
            $table->string('gioi_tinh');
            $table->date('ngay_sinh');
            $table->integer('id_nganh');
            $table->string('mo_ta')->nullable();
            $table->string('lop_co_van')->nullable();
            $table->integer('is_active')->default(0);
            $table->string('hash_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinh_viens');
    }
};
