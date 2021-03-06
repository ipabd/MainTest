<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user')->get();
    }

    public function perms()
    {
        return $this->belongsToMany(Permission::class, 'permission_role')->get();
    }
}
