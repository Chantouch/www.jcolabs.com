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
        Qualification::create([
            'name' => 'High School',
            'description' => 'High School',
            'status' => 1
        ]);
        Qualification::create([
            'name' => 'Bachelor Degree',
            'description' => 'Bachelor',
            'status' => 1
        ]);
        Qualification::create([
            'name' => 'Master Degree',
            'description' => 'Master Degree',
            'status' => 1
        ]);
        Qualification::create([
            'name' => 'Phd',
            'description' => 'Phd',
            'status' => 1
        ]);
        Qualification::create([
            'name' => 'Doctor',
            'description' => 'Doctor',
            'status' => 1
        ]);
    }
}
