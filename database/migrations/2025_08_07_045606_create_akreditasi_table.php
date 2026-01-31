<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akreditasi', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ← INI YANG BENAR!

            $table->string('nama_program_studi');
            $table->string('jenjang');
            $table->year('tahun');
            $table->string('nilai');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akreditasi');
    }
};