<?php

namespace App\Repositories;

use App\Models\ContactPerson;
use InfyOm\Generator\Common\BaseRepository;

class ContactPersonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'contact_name',
        'department_id',
        'position_id',
        'employer_id',
        'phone_number',
        'email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactPerson::class;
    }
}
