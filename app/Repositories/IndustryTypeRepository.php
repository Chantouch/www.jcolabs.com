<?php

namespace App\Repositories;

use App\Models\IndustryType;
use InfyOm\Generator\Common\BaseRepository;

class IndustryTypeRepository extends BaseRepository
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
        return IndustryType::class;
    }
}
