<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'program_studi'; // wajib sesuai migration

    protected $fillable = [
        'nama_program_studi',
        'jenjang',
        'fakultas',
        'deskripsi',
        'keterangan',
    ];

    public $incrementing = false; // UUID
    protected $keyType = 'string';

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
