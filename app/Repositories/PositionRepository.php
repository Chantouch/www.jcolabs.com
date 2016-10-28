<?php

namespace App\Repositories;

use App\Models\Position;
use InfyOm\Generator\Common\BaseRepository;

class PositionRepository extends BaseRepository
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
        return Position::class;
    }
}
