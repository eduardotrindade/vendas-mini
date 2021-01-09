<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['id' => 11, 'abbreviation' => 'RO', 'name' => 'Rondônia'],
            ['id' => 12, 'abbreviation' => 'AC', 'name' => 'Acre'],
            ['id' => 13, 'abbreviation' => 'AM', 'name' => 'Amazonas'],
            ['id' => 14, 'abbreviation' => 'RR', 'name' => 'Roraima'],
            ['id' => 15, 'abbreviation' => 'PA', 'name' => 'Pará'],
            ['id' => 16, 'abbreviation' => 'AP', 'name' => 'Amapá'],
            ['id' => 17, 'abbreviation' => 'TO', 'name' => 'Tocantins'],
            ['id' => 21, 'abbreviation' => 'MA', 'name' => 'Maranhão'],
            ['id' => 22, 'abbreviation' => 'PI', 'name' => 'Piauí'],
            ['id' => 23, 'abbreviation' => 'CE', 'name' => 'Ceará'],
            ['id' => 24, 'abbreviation' => 'RN', 'name' => 'Rio Grande do Norte'],
            ['id' => 25, 'abbreviation' => 'PB', 'name' => 'Paraíba'],
            ['id' => 26, 'abbreviation' => 'PE', 'name' => 'Pernambuco'],
            ['id' => 27, 'abbreviation' => 'AL', 'name' => 'Alagoas'],
            ['id' => 28, 'abbreviation' => 'SE', 'name' => 'Sergipe'],
            ['id' => 29, 'abbreviation' => 'BA', 'name' => 'Bahia'],
            ['id' => 31, 'abbreviation' => 'MG', 'name' => 'Minas Gerais'],
            ['id' => 32, 'abbreviation' => 'ES', 'name' => 'Espírito Santo'],
            ['id' => 33, 'abbreviation' => 'RJ', 'name' => 'Rio de Janeiro'],
            ['id' => 35, 'abbreviation' => 'SP', 'name' => 'São Paulo'],
            ['id' => 41, 'abbreviation' => 'PR', 'name' => 'Paraná'],
            ['id' => 42, 'abbreviation' => 'SC', 'name' => 'Santa Catarina'],
            ['id' => 43, 'abbreviation' => 'RS', 'name' => 'Rio Grande do Sul'],
            ['id' => 50, 'abbreviation' => 'MS', 'name' => 'Mato Grosso do Sul'],
            ['id' => 51, 'abbreviation' => 'MT', 'name' => 'Mato Grosso'],
            ['id' => 52, 'abbreviation' => 'GO', 'name' => 'Goiás'],
            ['id' => 53, 'abbreviation' => 'DF', 'name' => 'Distrito Federal'],
        ]);

        $this->call(CitiesTableSeeder::class);
    }
}
