<?php

/**
 * Description - Role Class
 * @author Zeeshan N
 */

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\SaveRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * @author Zeeshan N
     */

    public $partial, $role, $permission;

    public function __construct()
    {
        $this->partial = 'admin.roles.';
        $this->role = new Role();
        $this->permission = new Permission();
    }

    /**
     * Description - Create Lists of Role
     * @author Zeeshan N
     */
    public function listing(Request $request)
    {
        try {
            $roles = $this->role->newQuery()->activeRole()->notSuperAdmin()->paginate(PAGINATE);
            return $this->createView($this->partial . 'index', 'Roles', ['roles' => $roles]);
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Role
     * @author Zeeshan N
     */
    public function create(Request $request)
    {
        try {
            // $roles = $this->role->newQuery()->activeRole()->get();
            // $permissions = $this->permission->newQuery()->activePermission()->get();
            $permissions = $this->permission->newQuery()->get();
            return $this->createView(
                $this->partial . '.create',
                'Roles',
                ['permissions' => $permissions]
            );
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Create view of Role
     * @author Zeeshan N
     */
    public function save(SaveRequest $request)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->updateRoleDetails($request);
            if ($role) {
                DB::commit();
                session()->flash('success', __('general.updated'));
                return redirect()->back();
            }

            DB::rollBack();
            session()->flash('error', __('general.error_updating'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Delete Role
     * @author Zeeshan N
     */
    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->newQuery()->where('id', $id)->activeRole()->first();
            if ($role) {
                $role->status = DELETE;
                if ($role->update()) {
                    DB::commit();
                    session()->flash('error', __('general.deleted'));
                    return redirect()->back();
                }
            }
            DB::rollBack();
            session()->flash('error', __('general.error_updating'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Edit view of Role
     * @author Zeeshan N
     */
    public function edit(Request $request, $id)
    {
        try {
            if ($id == SUPER_ADMIN) {
                // session()->flash('error', 'Role Not Found');
                return redirect()->back();
            }

            $role = $this->role->newQuery()->where('id', $id)->activeRole()->first();
            $permissions = $this->permission->newQuery()->get();
            $assigned = [];
            $actions = array_keys(config('default-data.privileges'));
            foreach ($role->permissions as $key => $rp) {
                if (in_array($rp->action, $actions)) {
                    $assigned[$rp->permission_id][$rp->action] = true;
                } else {
                    $assigned[$rp->permission_id][$rp->action] = true;
                }
            }

            $role->assignedPermission = $assigned;
            if ($role) {
                return $this->createView(
                    $this->partial . '.create',
                    'Roles',
                    [
                        'permissions'    => $permissions,
                        'role'           => $role
                    ]
                );
            }
            session()->flash('error', 'Role Not Found');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }

    /**
     * Description - Update Role
     * @author Zeeshan N
     */
    public function update(UpdateRequest $request)
    {
        try {
            if ($request['id'] == SUPER_ADMIN) {
                // session()->flash('error', 'Role Not Found');
                return redirect()->back();
            }
            DB::beginTransaction();
            $model = $this->role->newQuery()->where('id', $request['id'])->first();
            $role = $model->updateRoleDetails($request);
            if ($role) {
                DB::commit();
                session()->flash('success', __('general.updated'));
                return redirect()->back();
            }
            DB::rollBack();
            session()->flash('error', __('general.error_updating'));
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('general.error_msg'));
            return redirect()->back();
        }
    }
}
