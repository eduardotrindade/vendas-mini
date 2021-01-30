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
                'description' => 'LT 20 unidades',
                'quantity' => 20,
                'price' => 400,
                'is_active' => true,
                'profile_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'description' => 'LT 50 unidades',
                'quantity' => 50,
                'price' => 900,
                'is_active' => true,
                'profile_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'description' => 'LT 100 unidades',
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
                'description' => 'LT 1 unidade',
                'quantity' => 1,
                'price' => 120,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'description' => 'LT 3 unidades',
                'quantity' => 3,
                'price' => 300,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'description' => 'LT 10 unidades',
                'quantity' => 10,
                'price' => 900,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'description' => 'LT 20 unidades',
                'quantity' => 20,
                'price' => 1700,
                'is_active' => true,
                'profile_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
