<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pertandingan', function (Blueprint $table) {
            $table->string('logo_tuan_rumah')->nullable()->after('tim_tuan_rumah');
            $table->string('logo_tamu')->nullable()->after('tim_tamu');
        });
    }

    public function down(): void
    {
        Schema::table('pertandingan', function (Blueprint $table) {
            $table->dropColumn(['logo_tuan_rumah', 'logo_tamu']);
        });
    }
};