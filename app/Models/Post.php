<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'slug',
        'user_id',
        'status',
        'judul',
        'isi',
        'kategori',
        'gambar',
        'tanggal',
    ];

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //  TAMBAHKAN INI — RELASI KE MODEL USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}