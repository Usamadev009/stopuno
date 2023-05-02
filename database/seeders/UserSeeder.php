<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        User::insert([
            [
                'business_ref_id' => generateBusinessReferenceId(new User, config('default-data.ref_prefix.user')),
                'name' => 'Super Admin',
                'email' => 'sadmin@admin.com',
                'phone' => '1234567289',
                'password' => Hash::make('password'),
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN
            ],

            [
                'business_ref_id' => generateBusinessReferenceId(new User, config('default-data.ref_prefix.user')),
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone' => '093938933433',
                'password' => Hash::make('admin123@'),
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN
            ],

            [
                'business_ref_id' => generateBusinessReferenceId(new User, config('default-data.ref_prefix.user')),
                'name' => 'User',
                'email' => 'user@admin.com',
                'phone' => '093938933400',
                'password' => Hash::make('admin123@'),
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
