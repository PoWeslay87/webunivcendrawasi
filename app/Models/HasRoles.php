<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;  //  Tambahkan ini

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }

    public function hasRole($role)
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('name', $role)->exists();
        }

        return $this->roles()->where('name', $role)->exists();
    }
}