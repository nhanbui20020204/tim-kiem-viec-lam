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
        Schema::create('khoas', function (Blueprint $table) {
            $table->id();
            $table->string('ten_khoa');
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->string('email');
            $table->string('password');
            $table->string('link_website');
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
        Schema::dropIfExists('khoas');
    }
};
