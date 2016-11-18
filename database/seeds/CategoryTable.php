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
        $category = [
            [
                'name' => 'Accounting',
                'slug' => 'accounting',
                'description' => 'Accounting',
                'status' => 1
            ],
            [
                'name' => 'Administration',
                'slug' => 'administration',
                'description' => 'Administration',
                'status' => 1
            ],
            [
                'name' => 'Architecture/Engineering',
                'slug' => 'architecture-engineering',
                'description' => 'Architecture/Engineering',
                'status' => 1
            ],
            [
                'name' => 'Assistant/Secretary',
                'slug' => 'assistant-secretary',
                'description' => 'Assistant/Secretary',
                'status' => 1
            ],
            [
                'name' => 'Audit/Taxation',
                'slug' => 'audit-taxation',
                'description' => 'Audit/Taxation',
                'status' => 1
            ]

        ];

        foreach ($category as $key => $value) {
            Category::create($value);
        }
    }
}
