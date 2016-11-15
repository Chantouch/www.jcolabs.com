<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
