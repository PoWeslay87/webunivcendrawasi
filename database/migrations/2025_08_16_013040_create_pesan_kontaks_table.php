<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesan_kontaks', function (Blueprint $table) {
            $table->uuid('id')->primary();    // ganti $table->id() jadi UUID
            $table->string('nama');
            $table->string('email');
            $table->string('subjek')->nullable();
            $table->text('pesan');
            $table->enum('status', ['baru', 'dibaca', 'dibalas'])->default('baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_kontaks');
    }
};
