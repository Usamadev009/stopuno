<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission')->truncate();

        $permission = [
            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'platform',
                'title' => 'Platform',
                'short_code' => 'platform',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'category',
                'title' => 'Category',
                'short_code' => 'category',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'role',
                'title' => 'Roles',
                'short_code' => 'role',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'seller_service',
                'title' => 'Business',
                'short_code' => 'seller_service',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'delivery',
                'title' => 'Delivery',
                'short_code' => 'delivery',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'driver',
                'title' => 'Driver',
                'short_code' => 'driver',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'coupon',
                'title' => 'Coupon',
                'short_code' => 'coupon',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'deal',
                'title' => 'Deal',
                'short_code' => 'deal',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'subscription',
                'title' => 'Subscription',
                'short_code' => 'subscription',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'order',
                'title' => 'Order',
                'short_code' => 'order',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),

            array(
                'business_ref_id' => generateBusinessReferenceId(new Permission, 'PER'),
                'module' => 'user',
                'title' => 'Users',
                'short_code' => 'user',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        ];

        Permission::insert($permission);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
