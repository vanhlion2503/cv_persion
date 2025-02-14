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
        // Kiểm tra xem bảng 'socials' đã tồn tại chưa
        if (!Schema::hasTable('socials')) {
            Schema::create('socials', function (Blueprint $table) {
                $table->id();
                $table->string('name');  // Tên mạng xã hội
                $table->string('icon');  // Icon (FontAwesome hoặc URL)
                $table->string('url');   // Link mạng xã hội
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socials');
    }
};