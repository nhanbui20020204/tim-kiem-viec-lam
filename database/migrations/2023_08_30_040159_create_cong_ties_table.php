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
        Schema::create('cong_ties', function (Blueprint $table) {
            $table->id();
            $table->string('ten_cong_ty');
            $table->string('slug_cong_ty');
            $table->string('dia_chi');
            $table->string('so_dien_thoai');
            $table->longText('hinh_anh');
            $table->string('email');
            $table->longText('mo_ta');
            $table->string('password');
            $table->string('website');
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
        Schema::dropIfExists('cong_ties');
    }
};
