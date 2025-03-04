<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Mevcut tabloyu sil
        Schema::dropIfExists('product_size');

        // Yeni tabloyu oluştur
        Schema::create('product_size', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->primary(['product_id', 'size_id']); // Birleşik anahtar
        });
    }

    public function down(): void
    {
        // Rollback işlemi için tabloyu eski haline getir
        Schema::dropIfExists('product_size');

        // Eski tabloyu yeniden oluştur
        Schema::create('product_size', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
};
