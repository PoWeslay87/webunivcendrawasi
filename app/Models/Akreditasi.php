<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Akreditasi extends Model
{
    protected $table = 'akreditasi'; // TETAPKAN NAMA TABEL

    protected $fillable = [
        'nama_program_studi',
        'jenjang',
        'tahun',
        'nilai',
        'keterangan',
    ];

    // WAJIB: Gunakan UUID sebagai primary key
    public $incrementing = false;
    protected $keyType = 'uuid';

    //  Otomatis generate UUID saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString(); // ← INI GENERATE KE KOLOM 'id'
        });
    }
}