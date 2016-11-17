<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesTable extends Seeder
{

    public function run()
    {

        Language::create([
            'name' => 'ENGLISH',
            'description' => 'English language',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Language::create([
            'name' => 'HINDI',
            'description' => 'HINDI language',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Language::create([
            'name' => 'ASSAMESE',
            'description' => 'ASSAMESE language',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Language::create([
            'name' => 'KHMER',
            'description' => 'Khmer language',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
