<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stadion', function (Blueprint $table) {
            $table->id('id_stadion');
            $table->string('nama_stadion', 100);
            $table->string('kota', 60);
            $table->integer('kapasitas');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stadion');
    }
};