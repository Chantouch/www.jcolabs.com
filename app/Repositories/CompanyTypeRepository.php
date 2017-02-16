<?php

namespace App\Repositories;

use App\Models\CompanyType;
use InfyOm\Generator\Common\BaseRepository;

class CompanyTypeRepository extends BaseRepository
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
        return CompanyType::class;
    }
}
