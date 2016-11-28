<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateExpDetails extends Model
{
    protected $table = 'candidate_experience_details';

    protected $guarded = ['_method', 'token'];

    protected $fillable = [
        'city_id',
        'career_level',
        'candidate_id',
        'company_name',
        'contract_type',
        'country',
        'department_id',
        'description',
        'end_date',
        'industry_id',
        'is_working',
        'job_title',
        'salary',
        'start_date',
    ];

    public static $rules = [
        'company_name' => 'required|max:50',
        'country' => 'required|max:50',
        'industry_id' => 'required|exists,industry_types,id',
    ];

    public static function career_level()
    {
        return [
            'Student / internship' => 'Student / internship',
            'Entry level' => 'Entry level',
            'Experienced (non-manager)' => 'Experienced (non-manager)',
            'Manager (supervisor of staff)' => 'Manager (supervisor of staff)',
            'Executive (VP, department head, etc.)' => 'Executive (VP, department head, etc.)',
            'Senior Executive (President, CEO, etc.)' => 'Senior Executive (President, CEO, etc.)',
            'Other' => 'Other',
        ];
    }

    public static function contract_type()
    {
        return [
            'Full Time' => 'Full Time',
            'Part Time' => 'Part Time',
            'Contract' => 'Contract',
            'Freelancer' => 'Freelancer',
            'Internship' => 'Internship',
            'Volunteer' => 'Volunteer'
        ];
    }
}
