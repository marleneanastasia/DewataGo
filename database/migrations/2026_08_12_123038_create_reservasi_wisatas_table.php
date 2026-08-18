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
    Schema::create('reservasi_wisatas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('destinasi_wisata_id')->constrained()->onDelete('cascade');
        $table->date('tanggal_kunjungan');
        $table->integer('jumlah_tiket');
        $table->integer('total_harga');
        $table->enum('status', ['menunggu', 'dikonfirmasi', 'dibatalkan'])->default('menunggu');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('reservasi_wisatas');
}
};