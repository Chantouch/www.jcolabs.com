<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateEduDetails extends Model
{
    protected $table = 'candidate_edu_details';

    protected $guarded = ['_method', '_token'];

    public static $rules = [
        'exam_id' => 'required|exists,exams,id',
        'board_id' => 'required|exists,boards,id',
        'subject_id' => 'sometimes',
        'specialization' => 'required|max:50',
        'pass_year' => 'required|numeric',
        'percentage' => 'required|numeric',
    ];


}
