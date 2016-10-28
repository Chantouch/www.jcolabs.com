<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'is_super_admin' => 1,
            'verified' => 1,
            'mobile_no' => '0704737234',
            'password' => bcrypt('secret'),
        ]);
    }
}
