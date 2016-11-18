<?php

use Illuminate\Database\Seeder;
use App\Models\Qualification;

class QualificationTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qualification = [
            [
                'name' => 'High School',
                'description' => 'High School',
                'status' => 1
            ], [
                'name' => 'Bachelor Degree',
                'description' => 'Bachelor',
                'status' => 1
            ],
            [
                'name' => 'Master Degree',
                'description' => 'Master Degree',
                'status' => 1
            ],
            [
                'name' => 'Phd',
                'description' => 'Phd',
                'status' => 1
            ],
            [
                'name' => 'Doctor',
                'description' => 'Doctor',
                'status' => 1
            ]

        ];

        foreach ($qualification as $key => $value) {
            Qualification::create($value);
        }
    }
}
