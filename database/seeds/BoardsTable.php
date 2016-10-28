<?php

use Illuminate\Database\Seeder;
use App\Models\Board;

class BoardsTable extends Seeder
{

    public function run()
    {

        Board::create(['name' => 'UP']);
        Board::create(['name' => 'PPIU']);
        Board::create(['name' => 'PPIT']);
        Board::create(['name' => 'RULE']);
        Board::create(['name' => 'RUPP']);
        Board::create(['name' => 'WS']);
    }
}
