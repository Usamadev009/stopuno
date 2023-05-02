<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\RolePermission;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_permission')->truncate();

        // super admin
        $superAdminPermissions = Permission::all();
        $superAdminRolePermissions = [];
        foreach ($superAdminPermissions as $superAdminPermission) {
            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => SUPER_ADMIN,
                "action" => CAN_VIEW_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => SUPER_ADMIN,
                "action" => CAN_ADD_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => SUPER_ADMIN,
                "action" => CAN_UPDATE_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => SUPER_ADMIN,
                "action" => CAN_DELETE_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => ADMIN,
                "action" => CAN_VIEW_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => ADMIN,
                "action" => CAN_ADD_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => ADMIN,
                "action" => CAN_UPDATE_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $superAdminRolePermissions[] = [
                "permission_id" => $superAdminPermission->id,
                "role_id" => ADMIN,
                "action" => CAN_DELETE_ACTION,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        RolePermission::insert($superAdminRolePermissions);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
