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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('total_spent', 10, 2)->default(0); // Kullanıcının toplam harcaması
            $table->decimal('referral_revenue', 10, 2)->default(0); // Referanslardan gelen kazanç
            $table->integer('referral_cycle')->default(0); // Referans devriyesi
            $table->string('referral_code')->unique()->nullable();
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->foreign('referred_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['referral_code', 'referred_by', 'total_spent', 'referral_revenue', 'referral_cycle']);
        });
    }
};
