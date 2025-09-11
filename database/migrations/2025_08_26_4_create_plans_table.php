<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama paket: Gratis, Premium
            $table->decimal('price', 12, 2)->nullable(); // Harga paket
            $table->integer('quota_ads'); // Jumlah iklan yang didapat
            $table->integer('duration_days')->nullable(); // Lama aktif paket dalam hari
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};