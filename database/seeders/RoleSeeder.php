<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role')->truncate();

        $roles = [
            [
                'id' => 1,
                'business_ref_id' => generateBusinessReferenceId(new Role, 'RL'),
                'title' => 'Super Admin',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'business_ref_id' => generateBusinessReferenceId(new Role, 'RL'),
                'title' => 'Admin',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        Role::insert($roles);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
