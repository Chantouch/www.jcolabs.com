<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Qualification;
use App\Models\Category;

class SubjectsTable extends Seeder
{

    public function run()
    {

        Subject::create(['name' => 'ACCOUNTANCY']);
        Subject::create(['name' => 'ARCHITECTURE']);
        Subject::create(['name' => 'COMMERCE']);
        Subject::create(['name' => 'COMPUTER SCIENCE AND TECHNOLOGY']);
        Subject::create(['name' => 'ELECTRONICS AND COMMUNICATION']);

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

        Category::create([
            'name' => 'Accounting',
            'description' => 'Accounting',
            'status' => 1
        ]);
        Category::create([
            'name' => 'Administration',
            'description' => 'Administration',
            'status' => 1
        ]);
        Category::create([
            'name' => 'Architecture/Engineering',
            'description' => 'Architecture/Engineering',
            'status' => 1
        ]);
        Category::create([
            'name' => 'Assistant/Secretary',
            'description' => 'Assistant/Secretary',
            'status' => 1
        ]);
        Category::create([
            'name' => 'Audit/Taxation',
            'description' => 'Audit/Taxation',
            'status' => 1
        ]);
    }
}
