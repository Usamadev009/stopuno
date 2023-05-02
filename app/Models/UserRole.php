<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'user_role';

    /**
     * Get all of the Roles for the UserRole
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_id');
    }
}
