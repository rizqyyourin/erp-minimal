<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'permissions'];

    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function hasPermission($permission): bool
    {
        if (!$this->permissions) {
            return false;
        }

        // Super admin with wildcard permission has access to everything
        if (in_array('*', $this->permissions)) {
            return true;
        }

        return in_array($permission, $this->permissions);
    }
}
