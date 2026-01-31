<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteStat extends Model
{
    protected $fillable = [
        'label','value','suffix','headline','description','icon','sort','is_active'
    ];

    // UUID setting
    public $incrementing = false; // karena ID bukan auto-increment
    protected $keyType = 'string'; // tipe primary key string

    // otomatis generate UUID saat membuat record baru
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
