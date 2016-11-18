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

        $city = [
            [
                'name' => 'Phnom Penh',
                'slug' => 'phnom-penh',
                'description' => 'Phnom Penh',
                'status' => 1
            ],
            [
                'name' => 'Kompong Change',
                'slug' => 'kompong-change',
                'description' => 'Kompong Change',
                'status' => 1
            ],
            [
                'name' => 'Siem Reap',
                'slug' => 'siem-reap',
                'description' => 'Siem Reap',
                'status' => 1
            ],
            [
                'name' => 'Svay Rieng',
                'slug' => 'svay-rieng',
                'description' => 'Svay Rieng',
                'status' => 1
            ],
            [
                'name' => 'Kompong Thorm',
                'slug' => 'kompong-thorm',
                'description' => 'Kompong Thorm',
                'status' => 1
            ],
            [
                'name' => 'Kompong Spue',
                'slug' => 'kompong-spue',
                'description' => 'Kompong Spue',
                'status' => 1
            ],
            [
                'name' => 'Kandal',
                'slug' => 'kandal',
                'description' => 'Kandal',
                'status' => 1
            ],
            [
                'name' => 'Battom Bong',
                'slug' => 'battom-bong',
                'description' => 'Battom Bong',
                'status' => 1
            ]
        ];

        foreach ($city as $key => $value) {
            City::create($value);
        }
    }
}
