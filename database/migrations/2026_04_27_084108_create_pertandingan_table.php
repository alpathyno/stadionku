<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertandingan', function (Blueprint $table) {
            $table->id('id_pertandingan');
            $table->foreignId('id_stadion')->constrained('stadion', 'id_stadion')->onDelete('cascade');
            $table->string('tim_tuan_rumah', 80);
            $table->string('tim_tamu', 80);
            $table->date('tanggal_pertandingan');
            $table->time('jam_mulai');
            $table->enum('status', ['Terjadwal', 'Dijual', 'Berlangsung', 'Selesai', 'Dibatalkan'])->default('Terjadwal');
            $table->decimal('harga_min', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertandingan');
    }
};