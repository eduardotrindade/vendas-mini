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
                'description' => 'LT 10 unidades',
                'quantity' => 10,
                'price' => 300,
                'is_active' => true,
                'profile_id' => 2,
                'conta_azul_code' => '19e6855a-cdb6-4c30-940a-74ba7bca37ea',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'description' => 'LT 20 unidades',
                'quantity' => 20,
                'price' => 680,
                'is_active' => true,
                'profile_id' => 2,
                'conta_azul_code' => '70567949-23d5-41ea-8a40-a5c38f283b55',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'description' => 'LT 50 unidades',
                'quantity' => 50,
                'price' => 1400,
                'is_active' => true,
                'profile_id' => 2,
                'conta_azul_code' => '566cfcb1-7f33-4db9-9cfa-f234d40e99be',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'description' => 'LT 100 unidades',
                'quantity' => 100,
                'price' => 2700,
                'is_active' => true,
                'profile_id' => 2,
                'conta_azul_code' => '566cfcb1-7f33-4db9-9cfa-f234d40e99be',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'description' => 'Semente Digital',
                'quantity' => 0,
                'price' => 0,
                'is_active' => true,
                'profile_id' => 2,
                'conta_azul_code' => '5f294988-b97d-4504-9f5b-58cc8a21e61b',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'description' => 'LT 1 unidade',
                'quantity' => 1,
                'price' => 60,
                'is_active' => true,
                'profile_id' => 3,
                'conta_azul_code' => 'bf5ae6b4-fe56-4c4a-bce6-d4893edf58b8',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'description' => 'LT 3 unidades',
                'quantity' => 3,
                'price' => 180,
                'is_active' => true,
                'profile_id' => 3,
                'conta_azul_code' => '0c37262e-85be-4973-9327-6ff6581e1d77',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'description' => 'LT 10 unidades',
                'quantity' => 10,
                'price' => 580,
                'is_active' => true,
                'profile_id' => 3,
                'conta_azul_code' => '369af564-5a44-4ab9-ad71-4e25e0b142ad',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'description' => 'LT 20 unidades',
                'quantity' => 20,
                'price' => 1150,
                'is_active' => true,
                'profile_id' => 3,
                'conta_azul_code' => 'f0ddb575-3700-44d5-9d60-2264c48709a3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
