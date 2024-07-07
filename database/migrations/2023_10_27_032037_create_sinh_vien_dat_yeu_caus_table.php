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
        Schema::create('sinh_vien_dat_yeu_caus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tieu_chi');
            $table->integer('id_sinh_vien');
            $table->integer('id_khoa');
            $table->integer('is_chon');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinh_vien_dat_yeu_caus');
    }
};
