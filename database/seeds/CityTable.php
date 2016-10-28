<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CityTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(['name' => 'Phnom Penh']);
        City::create(['name' => 'Kompong Change']);
        City::create(['name' => 'Siem Reap']);
        City::create(['name' => 'Svay Rieng']);
        City::create(['name' => 'Kompong Thorm']);
        City::create(['name' => 'Kompong Spue']);
        City::create(['name' => 'Kandal']);
        City::create(['name' => 'Battom Bong']);
    }
}
