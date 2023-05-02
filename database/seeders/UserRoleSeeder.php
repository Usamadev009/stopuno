<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_role')->truncate();

        $roles = [
            [
                'id' => 1,
                'user_id' => SUPER_ADMIN,
                'role_id' => SUPER_ADMIN,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'user_id' => ADMIN,
                'role_id' => ADMIN,
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        UserRole::insert($roles);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
