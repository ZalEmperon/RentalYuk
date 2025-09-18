<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['mobil', 'motor']);
            $table->string('brand'); // Merek: Toyota, Honda
            $table->string('model'); // Model: Avanza, Beat
            $table->integer('year'); // Tahun: 2022
            $table->text('description');
            $table->decimal('price_per_day', 12, 2);
            $table->string('city');
            $table->string('transmission');
            $table->string('capacity');
            $table->string('fuel_type');
            $table->integer('view_count')->default(0);
            $table->text('address');
            $table->string('main_photo_url')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->enum('mod_status', ['approve', 'waiting', 'reject'])->default('waiting');
            $table->boolean('is_premium')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};