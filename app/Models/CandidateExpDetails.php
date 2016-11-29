<?php

namespace App\Models;

use App\Model\frontend\Candidate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class CandidateExpDetails extends Model
{
    use  SoftDeletes;
    protected $table = 'candidate_experience_details';
    protected $guarded = ['_method', 'token'];
    protected $dates = ['start_date', 'end_date'];
    protected $fillable = [
        'city_id', 'career_level', 'candidate_id', 'company_name',
        'contract_type', 'country', 'department_id', 'description',
        'end_date', 'industry_id', 'is_working', 'job_title',
        'salary', 'start_date',
    ];

    public static $rules = [
        'company_name' => 'required|max:50',
        'country' => 'required|max:50',
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

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function setEndDateAttribute($value)
    {
        if (strlen($value)) {
            $this->attributes['end_date'] = Carbon::createFromFormat('Y-m-d', $value);
        } else {
            $this->attributes['end_date'] = null;
        }
    }

    public function getStartDateAttribute($value)
    {
        if (strlen($value)) {
            return Carbon::parse($this->attributes['start_date'])->format('Y-m-d');
        } else {
            return $this->attributes['start_date'] = null;
        }
    }

    public function getEndDateAttribute($value)
    {
        if (strlen($value)) {
            return Carbon::parse($this->attributes['end_date'])->format('Y-m-d');
        } else {
            return $this->attributes['end_date'] = null;
        }
    }
}
