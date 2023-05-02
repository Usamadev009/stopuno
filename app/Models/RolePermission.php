<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RolePermission extends Model
{
    use HasFactory, BaseModel;

    protected $table = 'role_permission';

    /**
     * Get all of the Permissions for the RolePermissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * Description - Checc Permissions access
     * @param array $request
     * @author Umar A
     */
    public function hasPermission($modules)
    {
        // if ($this->permission)

        //     return false;
    }

    /**
     * Description - Save / Update Role Permission Info
     * @param array $request
     * @author Umar A
     */
    public function updateRolePermissionDetails($request, $roleId)
    {
        $rp = RolePermission::where('role_id', $roleId)->delete();
        foreach ($request['privs'] as $id => $privs) {
            foreach ($privs as $value) {
                $rp = new RolePermission();
                $rp->role_id = $roleId;
                $rp->permission_id = $id;
                $rp->action = $value;
                $rp->status = ACTIVE;
                $rp->created_by = Auth::id();
                $rp->updated_by = Auth::id();
                if (!$rp->save()) {
                    return false;
                }
            }
        }

        return true;
    }
}
