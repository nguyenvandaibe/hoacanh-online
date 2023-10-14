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
        Schema::create('pots', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Tên chậu');
            $table->text('image')->comment('URL hình ảnh của chậu');
            $table->unsignedInteger('dimesion_length')->comment('Chiều dài (cm)');
            $table->unsignedInteger('dimesion_width')->comment('Chiều rộng (cm)');
            $table->unsignedInteger('dimesion_height')->comment('Chiều cao (cm)');
            $table->unsignedBigInteger('price')->comment('Giá bán (VNĐ)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pots');
    }
};
