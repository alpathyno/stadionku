<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kursi', function (Blueprint $table) {
            $table->id('id_kursi');
            $table->foreignId('id_stadion')->constrained('stadion', 'id_stadion')->onDelete('cascade');
            $table->string('nomor_kursi', 10);
            $table->string('tribun', 30);
            $table->enum('kategori', ['VIP', 'Tribune', 'Economy']);
            $table->enum('status', ['Tersedia', 'Terisi'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kursi');
    }
};