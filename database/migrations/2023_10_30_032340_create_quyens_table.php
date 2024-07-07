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
        Schema::create('quyens', function (Blueprint $table) {
            $table->id();
            $table->string('ten_quyen');
            $table->string('slug');
            $table->string('list_rule')->nullable();
            $table->integer('is_open')->default(1);
            $table->integer('is_master')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quyens');
    }
};
