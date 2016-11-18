<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Qualification;
use App\Models\Category;

class SubjectsTable extends Seeder
{

    public function run()
    {

        $subject = [
            [
                'name' => 'ACCOUNTANCY',
                'description' => 'ACCOUNTANCY',
                'status' => 1
            ],
            [
                'name' => 'ARCHITECTURE',
                'description' => 'ARCHITECTURE',
                'status' => 1
            ],
            [
                'name' => 'COMMERCE',
                'description' => 'COMMERCE',
                'status' => 1
            ],
            [
                'name' => 'COMPUTER SCIENCE AND TECHNOLOGY',
                'description' => 'COMPUTER SCIENCE AND TECHNOLOGY',
                'status' => 1
            ],
            [
                'name' => 'ELECTRONICS AND COMMUNICATION',
                'description' => 'ELECTRONICS AND COMMUNICATION',
                'status' => 1
            ]
        ];

        foreach ($subject as $key => $value) {
            Subject::create($value);
        }

    }
}
