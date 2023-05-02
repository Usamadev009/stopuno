<?php

/**
 * Permission Model
 * @author Umar A
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permission';

    /**
     * Get Active Permission filter
     * @author Umar A
     */
    public function scopeActivePermission($query)
    {
        return $query->where('status', ACTIVE);
    }
}
