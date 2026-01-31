<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // 🔥 GANTI id() menjadi uuid() sebagai primary key
            $table->uuid('id')->primary(); // ← INI YANG BARU

            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('judul');
            $table->text('isi');
            $table->string('kategori')->nullable();
            $table->string('gambar')->nullable();
            $table->date('tanggal')->nullable();

            // 👇 HAPUS baris ini — karena sekarang kita pakai 'id' sebagai UUID
            // $table->uuid('uuid')->unique(); // ← TIDAK PERLU LAGI!

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};