<?php

use App\Models\DepartmentType;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\IndustryType;

class IndustryTypesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $industry = [
            [
                'name' => 'IT',
                'slug' => 'it',
                'description' => 'IT',
                'status' => 1
            ],
            [
                'name' => 'Engineering',
                'slug' => 'engineering',
                'description' => 'Engineering',
                'status' => 1
            ],
            [
                'name' => 'Electrical',
                'slug' => 'electrical',
                'description' => 'Electrical',
                'status' => 1
            ],
            [
                'name' => 'Construction',
                'slug' => 'construction',
                'description' => 'Construction',
                'status' => 1
            ],
            [
                'name' => 'Automobiles',
                'slug' => 'automobiles',
                'description' => 'Automobiles',
                'status' => 1
            ],
            [
                'name' => 'Printing',
                'slug' => 'printing',
                'description' => 'Printing',
                'status' => 1
            ]
        ];

        foreach ($industry as $key => $value) {
            IndustryType::create($value);
        }

        $department_type = [
            [
                'name' => 'IT',
                'description' => 'IT',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Account',
                'description' => 'Account',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'HR',
                'description' => 'Human Resource',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($department_type as $key => $value) {
            DepartmentType::create($value);
        }


        $position = [
            [
                'name' => 'HR Manager',
                'description' => 'Help HR',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'IT Manager',
                'description' => 'Help HR',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sale Consultant',
                'description' => 'Help HR',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($position as $key => $value) {
            Position::create($value);
        }
    }
}
