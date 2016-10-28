<?php

namespace App\Repositories;

use App\Models\Board;
use InfyOm\Generator\Common\BaseRepository;

class BoardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Board::class;
    }
}
