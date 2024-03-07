<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $cities = [
            ['name' => 'Casablanca'],
            ['name' => 'Rabat'],
            ['name' => 'Fes'],
            ['name' => 'Marrakech'],
            ['name' => 'Tangier'],
            ['name' => 'Agadir'],
            ['name' => 'Oujda'],
            ['name' => 'Essaouira'],
            ['name' => 'Nador'],
            ['name' => 'Laayoune'],
        ];

        DB::table('cities')->insert($cities);
    }
}
