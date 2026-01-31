<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'  // nama role, misal: admin, user, editor
    ];

    /**
     * Relasi many-to-many dengan User
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user'); // pivot table
    }
}