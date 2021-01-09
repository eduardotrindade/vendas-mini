<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            ['id' => 1, 'name' => 'Administrador'],
            ['id' => 2, 'name' => 'Master'],
            ['id' => 3, 'name' => 'Afiliado']
        ]);
    }
}
