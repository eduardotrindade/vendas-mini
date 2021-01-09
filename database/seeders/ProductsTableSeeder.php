<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'description' => 'unidades',
                'quantity' => 20,
                'price' => 400,
                'is_active' => true,
                'profile_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'description' => 'unidades',
                'quantity' => 50,
                'price' => 900,
                'is_active' => true,
                'profile_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'description' => 'unidades',
                'quantity' => 100,
                'price' => 1800,
                'is_active' => true,
                'profile_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'description' => 'Semente Digital',
                'quantity' => 0,
                'price' => 0,
                'is_active' => true,
                'profile_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'description' => 'unidades',
                'quantity' => 1,
                'price' => 90,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'description' => 'unidades',
                'quantity' => 3,
                'price' => 240,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'description' => 'unidades',
                'quantity' => 10,
                'price' => 700,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'description' => 'unidades',
                'quantity' => 20,
                'price' => 1200,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
