<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PesanKontak extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'status',
        'read_at', // Tambahkan ini!
    ];

    // Default status "baru"
    protected $attributes = [
        'status' => 'baru'
    ];

    // ===============================
    // UUID Setting
    // ===============================
    public $incrementing = false; // UUID
    protected $keyType = 'string';

    //  Tambahkan ini — biar read_at otomatis jadi Carbon\Carbon
    protected $casts = [
        'read_at' => 'datetime', // ← INI PENTING!
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}