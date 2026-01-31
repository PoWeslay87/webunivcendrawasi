<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('program_studi')) {
            Schema::table('program_studi', function (Blueprint $table) {
                if (!Schema::hasColumn('program_studi', 'keterangan')) {
                    $table->text('keterangan')->nullable()->after('deskripsi');
                }
            });

            // opsional copy
            DB::statement("UPDATE program_studi SET keterangan = deskripsi WHERE keterangan IS NULL");
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('program_studi') && Schema::hasColumn('program_studi', 'keterangan')) {
            Schema::table('program_studi', function (Blueprint $table) {
                $table->dropColumn('keterangan');
            });
        }
    }
};
