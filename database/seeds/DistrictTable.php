<?php

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictTable extends Seeder
{

    public function run()
    {

        District::create(['city_id' => '1', 'name' => 'Anjaw']);
        District::create(['city_id' => '2', 'name' => 'Changlang']);
        District::create(['city_id' => '3', 'name' => 'East Siang']);
        District::create(['city_id' => '4', 'name' => 'East Kameng']);
        District::create(['city_id' => '5', 'name' => 'Kurung Kumey']);
        District::create(['city_id' => '6', 'name' => 'Lohit']);
        District::create(['city_id' => '7', 'name' => 'Lower Dibang Valley']);
        District::create(['city_id' => '7', 'name' => 'Lower Subansiri']);
        District::create(['city_id' => '5', 'name' => 'Papum Pare']);
        District::create(['city_id' => '6', 'name' => 'Tawang']);
        District::create(['city_id' => '4', 'name' => 'Tirap']);
        District::create(['city_id' => '3', 'name' => 'Dibang Valley']);
        District::create(['city_id' => '2', 'name' => 'Upper Siang']);
        District::create(['city_id' => '1', 'name' => 'Upper Subansiri']);
        District::create(['city_id' => '4', 'name' => 'West Kameng']);
        District::create(['city_id' => '6', 'name' => 'West Siang']);

    }
}
