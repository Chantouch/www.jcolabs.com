<?php

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesTable extends Seeder
{

    public function run()
    {

        Language::create(['name' => 'ENGLISH']);
        Language::create(['name' => 'HINDI']);
        Language::create(['name' => 'ASSAMESE']);
    }
}
