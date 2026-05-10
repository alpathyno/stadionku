<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id('id_tiket');
            $table->foreignId('id_pertandingan')->constrained('pertandingan', 'id_pertandingan')->onDelete('cascade');
            $table->foreignId('id_penonton')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('id_kursi')->constrained('kursi', 'id_kursi')->onDelete('cascade');
            $table->string('kode_tiket', 20)->unique();
            $table->decimal('harga', 10, 2);
            $table->enum('status_tiket', ['Pending', 'Aktif', 'Digunakan', 'Dibatalkan'])->default('Pending');
            $table->datetime('tgl_pembelian');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};