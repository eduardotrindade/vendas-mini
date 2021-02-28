<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@minisitio.net',
                'email_verified_at' => now(),
                'password' => Hash::make('@MiniSitio2021'), // password
                'remember_token' => Str::random(10),
            ]
        ]);
    }
}
