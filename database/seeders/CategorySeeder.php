<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('category')->truncate();

        $category = [
            [
                'id' => 1,
                'business_ref_id' => generateBusinessReferenceId(new Category, 'CAT'),
                'name' => 'Burger',
                'platform_id' => '1',
                'description' => "This is a Category description",
                'image' => 'category/food.png',
                'banner' => 'category/food.png',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'business_ref_id' => generateBusinessReferenceId(new Category, 'CAT'),
                'name' => 'Pizza',
                'platform_id' => '1',
                'description' => "This is a Category description",
                'image' => 'category/food.png',
                'banner' => 'category/food.png',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'business_ref_id' => generateBusinessReferenceId(new Category, 'CAT'),
                'name' => 'Plumber',
                'platform_id' => '2',
                'description' => "This is a Instant Services description",
                'image' => 'instantservices/plumber.png',
                'banner' => 'instantservices/plumber.png',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'business_ref_id' => generateBusinessReferenceId(new Category, 'CAT'),
                'name' => 'Electrician',
                'platform_id' => '2',
                'description' => "This is a Instant Services description",
                'image' => 'instantservices/electrician.png',
                'banner' => 'instantservices/electrician.png',
                'status' => ACTIVE,
                'created_by' => SUPER_ADMIN,
                'updated_by' => SUPER_ADMIN,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Category::insert($category);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
