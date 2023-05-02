<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'role';

    protected $fillable = [
        'title'
    ];

    /**
     * Get all of the UserRole for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function userRoles()
    {
        return $this->belongsTo(UserRole::class, 'user_id', 'id');
    }

    /**
     * Get all of the RolePermission for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id')->where('status', ACTIVE);
    }

    /**
     * Fetch Active Status
     * @author Umar A
     */
    public function scopeActiveRole($query)
    {
        $query->where('status', ACTIVE);
    }

    /**
     * Fetch Restrict Super Admin Role
     * @author Umar A
     */
    public function scopeNotSuperAdmin($query)
    {
        $query->where('role.id', '!=', SUPER_ADMIN);
    }

    /**
     * Description - Save / Update Role Info
     * @param array $request
     * @author Umar A
     */
    public function updateRoleDetails($request)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.role'));
            $this->status = ACTIVE;
        }

        if ($this->saveUpdateInfo($this, $request->only('title'))) {
            if ((new RolePermission())->updateRolePermissionDetails($request, $this->id)) {
                return $this->refresh();
            }
        }
        return false;
    }

    /**
     * Check Permission Access
     * @author Umar A
     */
    public function hasAccess($modules = [], $actions = [])
    {
        $permissions = Permission::whereIn('module', $modules)->pluck('id');
        if ($permissions->count() > 0) {
            if ($this->permissions()->whereIn('permission_id', $permissions)->whereIn('action', $actions)->exists()) {
                return true;
            }
        }

        return false;
    }
}
