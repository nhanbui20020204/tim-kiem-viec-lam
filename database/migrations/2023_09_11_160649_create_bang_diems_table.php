<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bang_diems', function (Blueprint $table) {
            $table->id();
            $table->string('ma_mon');
            $table->string('ten_mon');
            $table->double('diem_so');
            $table->string('diem_chu');
            $table->string('hinh_anh')->nullable();
            $table->integer('id_sinh_vien');
            $table->integer('is_duyet')->default(0);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('bang_diems');
    }
};
