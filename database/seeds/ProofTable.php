<?php

use App\Models\ProofResidense;
use Illuminate\Database\Seeder;

class ProofTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProofResidense::create(['name' => 'Ration Card']);
        ProofResidense::create(['name' => 'Voter ID Card']);
        ProofResidense::create(['name' => 'Passport']);
    }
}
