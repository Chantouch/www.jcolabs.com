<?php

namespace App\Model\backend;

use App\Models\City;
use App\Models\ContactPerson;
use App\Models\District;
use App\Models\EmployerDocument;
use App\Models\IndustryType;
use App\Notifications\EmployerResetPassword;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employer extends Authenticatable
{
    use Notifiable;

    public $guarded = ['_token', 'name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_name',
        'organization_type',
        'organization_sector',
        'industry_id', 'address',
        'state_id', 'district_id',
        'pin_code', 'phone_no_ext',
        'phone_no_main', 'organisation_email',
        'web_address', 'organisation_id_proof',
        'organisation_profile', 'organisation_pan_card',
        'contact_name', 'contact_designation',
        'contact_mobile_no', 'contact_email',
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
        $this->notify(new EmployerResetPassword($token));
    }

    public static $messages = [
        'organization_name.between' => 'organization name must be at least minimum 3 characters',
        'contact_mobile_no.numeric' => 'Mobile No can only contain numbers',
        'password.confirmed' => 'Password and Confirm Password does not match',
        'web_address.url' => 'the Web Address field is not valid. Please ensure that you have added http:// at the beginning'
    ];

    public function rules()
    {

        return [
            'organization_name' => 'required|between:3,100,:id',
            'contact_mobile_no' => 'required|numeric|unique:employers,contact_mobile_no,{$this->id},id',
//            'organisation_email' => 'sometimes|email|required|max:100|unique:employers,organisation_email,id,id',
            'organisation_email' => "required|between:1,128|unique:employers",
            //'email' => 'email|required|max:255|unique:employers,email',
            'web_address' => 'url',
            'address' => 'required|max:255',
//        'password' => 'confirmed|required',
        ];

//        $employer = Employer::find($this->employers);
//
//        switch ($this->method()) {
//            case 'GET':
//            case 'DELETE': {
//                return [];
//            }
//            case 'POST': {
//                return [
//                    'organisation_email' => 'required|email|unique:users,email',
//                ];
//            }
//            case 'PUT':
//            case 'PATCH': {
//                return [
//
//                    'organisation_email' => "email|required|max:100|unique:employers,organisation_email" . $employer->id,
//
//                ];
//            }
//            default:
//                break;
//        }
    }

    public static $organization_type_options = [
        'Placement Agency' => 'Placement Agency',
        'Employer' => 'Employer',
        'Govt Training Providing Organisation' => 'Govt Training Providing Organisation'
    ];

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

    public static function job_types()
    {
        return [
            'Full Time' => 'Full Time',
            'Part Time' => 'Part Time',
            'Contract' => 'Contract',
            'Freelancer' => 'Freelancer'
        ];
    }

    public static function job_level()
    {
        return [
            'Entry' => 'Entry',
            'Senior' => 'Senior',
            'Junior' => 'Junior'
        ];
    }

    public static function qualification()
    {
        return [
            'Good' => 'Good'
        ];
    }

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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function documents()
    {
        return $this->hasMany(EmployerDocument::class);
    }

    public function contacts()
    {
        $this->hasMany(ContactPerson::class);
    }

    protected function setWebAddressAttribute($value)
    {
        $this->attributes['web_address'] = ($value == 'http//www.') ? '' : $value;
    }

    public function verified()
    {
        $this->status = 1;
        $this->confirmation_code = null;
        $this->save();
    }
}
