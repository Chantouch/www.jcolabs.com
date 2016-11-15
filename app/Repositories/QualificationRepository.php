<?php

namespace App\Repositories;

use App\Models\Qualification;
use InfyOm\Generator\Common\BaseRepository;

class QualificationRepository extends BaseRepository
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
        return Qualification::class;
    }
}
