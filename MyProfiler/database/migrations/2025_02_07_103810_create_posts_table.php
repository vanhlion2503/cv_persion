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
        // Kiểm tra xem bảng 'posts' đã tồn tại chưa
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title'); // Tiêu đề
                $table->string('tomtat'); // Nội dung tóm tắt
                $table->text('content'); // Nội dung chính
                $table->string('image')->nullable(); // Ảnh bài viết
                $table->timestamp('published_at')->nullable(); // Ngày đăng
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};