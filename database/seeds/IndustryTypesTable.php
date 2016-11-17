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
        IndustryType::create(['name' => 'IT']);
        IndustryType::create(['name' => 'Engineering']);
        IndustryType::create(['name' => 'Electrical']);
        IndustryType::create(['name' => 'Construction']);
        IndustryType::create(['name' => 'Automobiles']);
        IndustryType::create(['name' => 'Printing']);

        DepartmentType::create([
            'name' => 'IT',
            'description' => 'IT',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DepartmentType::create([
            'name' => 'Account',
            'description' => 'Account',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DepartmentType::create([
            'name' => 'HR',
            'description' => 'Human Resource',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Position::create([
            'name' => 'HR Manager',
            'description' => 'Help HR',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Position::create([
            'name' => 'IT Manager',
            'description' => 'Help HR',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Position::create([
            'name' => 'Sale Consultant',
            'description' => 'Help HR',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
