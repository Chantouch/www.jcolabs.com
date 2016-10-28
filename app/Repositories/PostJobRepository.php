<?php

namespace App\Repositories;

use App\Models\PostedJob;
use InfyOm\Generator\Common\BaseRepository;

class PostJobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_name',
        'no_of_post',
        'industry_id',
        'place_of_employment_city_id',
        'place_of_employment_district_id',
        'preferred_age_min',
        'preferred_age_max',
        'salary_offered_max',
        'salary_offered_min',
        'job_sub_category',
        'preferred_caste',
        'exam_passed_id',
        'subject_id',
        'specialization',
        'preferred_experience',
        'ex_service',
        'physical_challenge',
        'physical_height',
        'physical_weight',
        'physical_chest',
        'physical_weight',
        'description',
        'contact_person_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostedJob::class;
    }
}
