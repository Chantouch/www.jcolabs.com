<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateExpDetails extends Model
{
    protected $table = 'candidate_experience_details';

    protected $guarded = ['_method', 'token'];

    public static $rules = [
        'employers_name' => 'required|max:50',
        'post_held' => 'required|max:50',
        'year_experience' => 'numeric|max:99',
        'salary' => 'required|numeric',
        'experience_id' => 'required|exists,subjects,id',
        'industry_id' => 'required|exists,industry_types,id',
    ];
}
