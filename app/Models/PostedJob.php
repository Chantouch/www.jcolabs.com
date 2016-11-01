<?php

namespace App\Models;

use App\Model\backend\Employer;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostedJob extends Model
{
    /**
     * Using sluggable to make url more friendly
     */
    use Sluggable;

    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'posted_jobs';
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'post_name',
        'emp_job_id',
        'status',
        'created_by',
        'salary_offered_max',
        'salary_offered_min',
        'no_of_post',
        'industry_id',
        'place_of_employment_city_id',
        'place_of_employment_district_id',
        'preferred_age_min',
        'preferred_age_max',
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
        'category_id',
        'contact_person_id',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['seo_url', 'district.name', 'exam.name'],
            ]
        ];
    }

//    /**
//     * @var array
//     */
//    protected $sluggable = [
//        'build_from' => ['seo_url', 'district.name', 'exam.name'],
//        'save_to' => 'slug',
//        'unique' => true
//    ];

    /**
     * @param string $value
     * @return string
     */
    public function getSeoUrlAttribute($value = '')
    {
        return $this->post_name . ' at ' . $this->employer->organization_name . ' ' . $this->subject->name;
    }

    /**
     * @var array
     */
    public static $rules = [
        'post_name' => 'required|min:3|max:255',
        'no_of_post' => 'required|numeric|digits_between:1,8',
        'preferred_age_min' => 'required|integer|min:15|max:80',
        //'preferred_age_max' => 'integer|min:0|max:100',
        'preferred_age_max' => 'required|integer|max:100',
        'salary_offered_min' => 'required|numeric',
        'salary_offered_max' => 'required|numeric',
        'subject_id' => 'required|exists:subjects,id',
        'job_sub_category' => 'required'
        //'phone_no_ext' => 'max:',
        //'preferred_age_max' => 'integer|min:0|max:100',
        //'industry_id'   =>  'required|exists,industry_types,id',
    ];

    /**
     * @var array
     */
    public static $message = [
        'subject_id.required' => 'The Subject field is required'
    ];
    /**
     * @var array
     */
    protected $guarded = [
        'id', '_token', '_method'
    ];
    //protected $fillable = ['name', 'exam_category', 'status', 'description'];
    //public static $exam_exam_categories = ['x1'=>'x1', 'x2'=>'x2', 'x3'=>'x3', 'other'=>'other'];
    //$exam_exam_categories
    //i have declared all the types i.e. enum values rather then querrying to reduce the db load
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function industry()
    {
        //return $this->hasMany('App\Models\CandidateEduDetails', 'candidate_id');
        return $this->belongsTo(IndustryType::class, 'industry_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employer()
    {
        //return $this->hasMany('App\Models\CandidateEduDetails', 'candidate_id');
        return $this->belongsTo(Employer::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function language()
    {
        return $this->belongsToMany(Language::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'place_of_employment_district_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'place_of_employment_city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_passed_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function contact_person()
    {
        return $this->belongsTo(ContactPerson::class, 'contact_person_id');
    }

    /**
     * @param $value
     * @return string
     */
    public function getPhysicalHeightAttribute($value)
    {
        return $this->attributes['physical_height'] = ($value == 0.00) ? '' : $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getPhysicalWeightAttribute($value)
    {
        return $this->attributes['physical_weight'] = ($value == 0.00) ? '' : $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getPhysicalChestAttribute($value)
    {
        return $this->attributes['physical_chest'] = ($value == 0.00) ? '' : $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getPreferredExperienceAttribute($value)
    {
        return $this->attributes['preferred_experience'] = ($value == 0) ? '' : $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getOtherBenefitsAttribute($value)
    {
        return $this->attributes['other_benefits'] = ($value == 0) ? '' : $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getJobStatusAttribute($value)
    {
        if ($this->attributes['status'] == 0)
            return '<span class="label label-warning"> Unpublished </span>';

        if ($this->attributes['status'] == 1)
            return '<span class="label label-success"> Active </span>';

        if ($this->attributes['status'] == 2)
            return '<span class="label label-danger"> Filled Up </span>';
    }

}
