database/migrations/2026_08_13_000002_add_promo_fields_to_destinasi_wisatas_table.php<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinasi_wisatas', function (Blueprint $table) {
            $table->integer('diskon')->nullable()->after('harga');          // persen, null = tanpa promo
            $table->boolean('unggulan')->default(false)->after('diskon');   // tampil di banner
        });
    }

    public function down(): void
    {
        Schema::table('destinasi_wisatas', function (Blueprint $table) {
            $table->dropColumn(['diskon', 'unggulan']);
        });
    }
};