<?php

namespace App\Repositories;

use App\Models\Subject;
use InfyOm\Generator\Common\BaseRepository;

class SubjectRepository extends BaseRepository
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
        return Subject::class;
    }
}
