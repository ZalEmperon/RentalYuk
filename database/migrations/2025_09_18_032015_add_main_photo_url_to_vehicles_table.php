<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Tambahkan kolom baru setelah kolom 'address'
            $table->string('main_photo_url')->nullable()->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn('main_photo_url');
        });
    }
};