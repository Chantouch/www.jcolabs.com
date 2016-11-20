<?php

namespace App\Models;

use App\Model\backend\Employer;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use DB;
use Session;
use Venturecraft\Revisionable\RevisionableTrait;


class PostedJob extends Model
{

    use RevisionableTrait;
    /**
     * Using sluggable to make url more friendly
     */
    use Sluggable;

    use SoftDeletes;

    /**
     * @var string
     */

    public static function boot()
    {
        parent::boot();
    }

    protected $table = 'posted_jobs';
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $revisionEnabled = true;
    protected $revisionCleanup = true; //Remove old revisions (works only when used with $historyLimit)
    protected $historyLimit = 500; //Maintain a maximum of 500 changes at any point of time, while cleaning up old revisions.
    protected $revisionCreationsEnabled = true;
    protected $revisionNullString = 'nothing';
    protected $revisionUnknownString = 'unknown';
    protected $revisionFormattedFields = array(
        'post_name'  => 'string:<strong>%s</strong>',
        'status' => 'boolean:No|Yes',
        'updated_at' => 'datetime:m/d/Y g:i A',
        'deleted_at' => 'isEmpty:Active|Deleted'
    );

    /**
     * @var array
     */
    protected $fillable = [
        'post_name', 'emp_job_id', 'status',
        'job_type', 'level', 'other_benefits',
        'created_by', 'salary_offered_max', 'salary_offered_min',
        'no_of_post', 'industry_id', 'place_of_employment_city_id',
        'place_of_employment_district_id', 'preferred_age_min',
        'preferred_age_max', 'category_id', 'preferred_religion',
        'subject_id', 'specialization', 'preferred_experience',
        'physical_height', 'physical_weight', 'description',
        'requirement_description', 'category_id', 'contact_person_id',
        'published_date', 'closing_date', 'qualification_id',
        'is_negotiable', 'field_of_study',
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
                'source' => ['seo_url', 'district.name'],
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
        return $this->post_name . ' at ' . $this->employer->organization_name . ' in ' . $this->city->name;
    }

    /**
     * @var array
     */
    public static $rules = [
        'post_name' => 'required|min:3|max:255',
        'no_of_post' => 'required|numeric|digits_between:1,8',
        'preferred_age_min' => 'required|integer|min:15|max:80',
        //'preferred_age_max' => 'integer|min:0|max:100',
        'preferred_age_max' => 'required|integer|greater_than:preferred_age_min|max:100',
        'salary_offered_min' => 'required|numeric',
        'salary_offered_max' => 'required|numeric|greater_than:salary_offered_min',
        'subject_id' => 'required|exists:subjects,id',
        'category_id' => 'required'
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
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function publish_date()
    {
        return Carbon::now();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_posted_job', 'posted_job_id', 'language_id')->withPivot('posted_job_id', 'language_id')->withTimestamps();
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
    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
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


    /**
     * @param $query
     * @internal param $job
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function scopeSearchJob($query)
    {
        $jobs = PostedJob::with('industry')->where('post_name', 'LIKE', "%{$query}%")->orderBy('id')->paginate(5);
        return $jobs;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSearch($query)
    {
        $keyword = \Request::get('searchjob');
        $city = \Request::get('searchplace');
        if (isset($keyword) || !is_null($keyword)) {
            $terms = explode(' ', $keyword); // Array of searchstrings
            foreach ($terms as $term) {
                //        ->where('place_of_employment_city_id', $city)->first();

                $query = $query->whereHas('city', function ($q) use ($city) {
//            $city = \Request::get('searchplace');
                    $q->where('place_of_employment_city_id', '=', $city)->with('city');

                });

                return $query->where('post_name', 'LIKE', "%" . $term . "%");
//            ->orWhere(DB::raw("CONCAT_WS(' ',salary_offered_max,salary_offered_min)"), 'like', "%" . $searchTerm . "%");
            }
        }
        return $query;

    }

    /**
     * @return
     * @internal param Request $request
     * @internal param $city
     */
    public function scopeSearchCity()
    {
        $city = City::where('status', 1);
        return $city;
    }

    public function scopeCrosstab($query, $wellID)
    {
        return $query->select('sampleDate', DB::raw("max(if(chemID=1, pfcLevel, ' ')) as 'PFOA', max(if(chemID=1, noteAbr, ' ')) as 'PFOANote'"))
            ->leftJoin('SampleNote', 'WellSample.noteID', '=', 'SampleNote.noteID')
            ->where('wellID', '=', $wellID)
            ->groupBy('sampleDate');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applies()
    {
        return $this->hasMany(ApplyJob::class);
    }

}
