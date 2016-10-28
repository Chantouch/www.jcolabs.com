<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employers')->insert([
            'contact_name' => 'Employer',
            'contact_email' => 'employer@example.com',
            'contact_mobile_no' => '04938282',
            'status' => 1,
            'temp_enrollment_no' => 'TMP00092',
            'organization_name' => 'Agency',
            'password' => bcrypt('secret'),
        ]);
    }
}
