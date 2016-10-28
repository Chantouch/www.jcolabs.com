<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(IndustryTypesTable::class);
        $this->call(CityTable::class);
        $this->call(DistrictTable::class);
        $this->call(LanguagesTable::class);
        $this->call(ExamsTable::class);
        $this->call(BoardsTable::class);
        $this->call(SubjectsTable::class);
        $this->call(ProofTable::class);
        $this->call(AdminsTable::class);
        $this->call(EmployersTable::class);

        Model::reguard();
    }
}
