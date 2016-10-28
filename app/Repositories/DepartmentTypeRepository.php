<?php

namespace App\Repositories;

use App\Models\DepartmentType;
use InfyOm\Generator\Common\BaseRepository;

class DepartmentTypeRepository extends BaseRepository
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
        return DepartmentType::class;
    }
}
