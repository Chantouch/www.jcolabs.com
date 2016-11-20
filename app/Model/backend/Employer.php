<?php

namespace App\Model\backend;

use App\Models\City;
use App\Models\ContactPerson;
use App\Models\District;
use App\Models\EmployerDocument;
use App\Models\IndustryType;
use App\Models\PostedJob;
use App\Notifications\EmployerResetPassword as ResetPasswordNotification;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Request;
use Illuminate\Notifications\Notifiable;

class Employer extends Authenticatable
{
    use Notifiable;
    use Sluggable;

    public $guarded = ['_token', 'name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_name', 'path', 'longitude',
        'organization_type', 'latitude',
        'organization_sector', 'services',
        'industry_id', 'address', 'products',
        'city_id', 'district_id',
        'pin_code', 'phone_no_ext',
        'phone_no_main', 'organisation_email',
        'web_address', 'organisation_id_proof',
        'organisation_profile', 'organisation_pan_card',
        'contact_name', 'contact_designation',
        'contact_mobile_no', 'email',
        'password', 'status', 'confirmation_code',
        'details', 'photo', 'tag_line',
        'web_address', 'temp_enrollment_no',
        'services', 'products', 'employees'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public static $messages = [
        'organization_name.between' => 'organization name must be at least minimum 3 characters',
        'contact_mobile_no.numeric' => 'Mobile No can only contain numbers',
        'password.confirmed' => 'Password and Confirm Password does not match',
        'web_address.url' => 'the Web Address field is not valid. Please ensure that you have added http:// at the beginning',
        'city_id.required' => 'Please select your city',
        'email.required' => 'Contact email is required',
        'details.required' => 'Please describe something about your company.',
        'district_id.required' => 'Please select your district',
    ];

    public function rules()
    {

//        return [
//            'organization_name' => 'required|between:3,100,:id',
//            'contact_mobile_no' => 'required|numeric|unique:employers,contact_mobile_no,{$this->id},id',
//            'organisation_email' => 'sometimes|email|required|max:100|unique:employers,organisation_email,id,id',
//            'web_address' => 'url',
//            'address' => 'required|max:255',
//        ];

        $employer = Auth::guard('employer')->user();

        switch (Request::method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'organisation_email' => 'required|organisation_email|unique:employers,organisation_email',
                    'organization_name' => 'required|between:3,100,:id',
                    'contact_mobile_no' => "required|numeric|unique:employers,contact_mobile_no,{$employer->id},id",
                    'web_address' => 'url',
                    'address' => 'required|max:255',
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [

                    'organisation_email' => 'required|max:100|unique:employers,organisation_email,' . $employer->id . ',id',
                    'organization_name' => 'required|between:3,100,:id',
                    'contact_mobile_no' => "required|numeric|unique:employers,contact_mobile_no,{$employer->id},id",
                    'web_address' => 'url',
                    'address' => 'required|max:255',
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'employees' => 'required|numeric|min:1',
                    'city_id' => 'required',
                    'contact_name' => 'required',
                    'district_id' => 'required',
                    'details' => 'required|max:5000'

                ];
            }
            default:
                break;
        }
    }

    /**
     * @var array
     */
    public static $organization_type_options = [
        'Placement Agency' => 'Placement Agency',
        'Employer' => 'Employer',
        'Govt Training Providing Organisation' => 'Govt Training Providing Organisation'
    ];

    /**
     * @var array
     */
    public static $organization_sector_options = [
        'Private' => 'Private',
        'Central Govt' => 'Central Govt',
        'State Govt' => 'State Govt',
        'Central PSU' => 'Central PSU',
        'State PSU' => 'State PSU',
        'Local Bodies' => 'Local Bodies',
        'Statutory Bodies' => 'Statutory Bodies',
        'Others' => 'Others'
    ];

    public static $job_sub_category = [
        'Govt. Regular' => 'Govt. Regular',
        'Govt. Contractual' => 'Govt. Contractual',
        'Pvt. Regular' => 'Pvt. Regular',
        'Pvt. Contractual' => 'Pvt. Contractual',
        'Not Specified' => 'Not Specified'
    ];

    /**
     * @return array
     *
     */
    public static function job_types()
    {
        return [
            '' => '--Select Type--',
            'Full Time' => 'Full Time',
            'Part Time' => 'Part Time',
            'Contract' => 'Contract',
            'Freelancer' => 'Freelancer',
            'Internship' => 'Internship',
            'Volunteer' => 'Volunteer',
        ];
    }

    /**
     * @return array
     */
    public static function job_level()
    {
        return [
            '' => '--Select Level--',
            'Non-Executive' => 'Entry',
            'Fresh Entry' => 'Fresh Entry',
            'Junior' => 'Junior',
            'Senior' => 'Senior',
            'Manager' => 'Manager',
            'CEO' => 'CEO',
            'Top Management' => 'Top Management',
        ];
    }

    /**
     * @return array
     */
    public static function qualification()
    {
        return [
            '1' => 'Good'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function industry()
    {
        return $this->belongsTo(IndustryType::class, 'industry_id');
    }

    //getJobStatusAttribute
    public function getEmployerEnrollmentAttribute()
    {
        //if(starts_with($this->temp_enrollment_no, 'TMP_EMP'){
        if ($this->verified_by == 0) {
            return $this->temp_enrollment_no;
        } else {
            return $this->enrollment_no;
        }
    }

    /**
     * @return string
     */
    public function getVerificationStatusAttribute()
    {
        $name = '';
        if ($this->verified_by == 0) {
            return 'Not Verified';
        } else {
            try {
                $admin = Admin::findOrFail($this->verified_by);
                $name = $admin->name;
            } catch (ModelNotFoundException $exception) {

            }
            return 'Verified by ' . $name;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(EmployerDocument::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(ContactPerson::class);
    }

    /**
     * @param $value
     */
    protected function setWebAddressAttribute($value)
    {
        $this->attributes['web_address'] = ($value == 'http//www.') ? '' : $value;
    }

    /**
     * @param $value
     */
    protected function setPhoneNoExtAttribute($value)
    {
        $this->attributes['phone_no_ext'] = ($value == '+855 ') ? '' : $value;
    }

    /**
     * verified employer
     */
    public function verified()
    {
        $this->status = 1;
        $this->confirmation_code = null;
        $this->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs()
    {
        return $this->hasMany(PostedJob::class, 'created_by');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['seo_url'],
            ]
        ];
    }

    /**
     * @param string $value
     * @return string
     */
    public function getSeoUrlAttribute($value = '')
    {
        return $this->organization_name;
    }
}
