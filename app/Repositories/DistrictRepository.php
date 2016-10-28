<?php

namespace App\Repositories;

use App\Models\District;
use InfyOm\Generator\Common\BaseRepository;

class DistrictRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'city_id',
        'description',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return District::class;
    }
}
