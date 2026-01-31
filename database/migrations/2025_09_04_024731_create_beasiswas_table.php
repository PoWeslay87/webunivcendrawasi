<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('beasiswas', function (Blueprint $table) {
        $table->id();
        $table->string('nama');          // nama beasiswa
        $table->text('deskripsi');       // deskripsi beasiswa
        $table->date('tanggal_mulai');   // periode mulai
        $table->date('tanggal_selesai'); // periode selesai
        $table->timestamps();
    });
}


    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beasiswas');
    }
};
