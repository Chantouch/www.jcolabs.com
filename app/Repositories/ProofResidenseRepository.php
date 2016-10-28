<?php

namespace App\Repositories;

use App\Models\ProofResidense;
use InfyOm\Generator\Common\BaseRepository;

class ProofResidenseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProofResidense::class;
    }
}
