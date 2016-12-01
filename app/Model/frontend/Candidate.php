<?php

namespace App\Model\frontend;

use App\Models\Accomplishment;
use App\Models\Attachment;
use App\Models\CandidateEduDetails;
use App\Models\CandidateExpDetails;
use App\Models\CandidateInfo;
use App\Models\CandidateLanguageInfo;
use App\Models\EduDetails;
use App\Models\ProfessionalSkill;
use App\Models\Reference;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Request;
use File;


class Candidate extends Authenticatable
{
    use Notifiable;

    protected $table = 'candidates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'confirmation_code',
        'password',
        'mobile_num',
        'github_id',
        'first_name',
        'last_name',
        'avatar',
        'nationality',
        'verified_status',
        'verified_by',
        'temp_enrollment_no',
        'address',
        'gender',
        'religion',
        'marital_status',
        'index_card_no',
        'dob',
        'status'
    ];

    public static $rules = [
        //'candidate_id' =>'exists:members,id',
        'first_name' => 'required|min:3|max:50',
        'last_name' => 'required|min:3|max:50',
        'gender' => 'required|in:MALE,FEMALE,OTHERS',
        'dob' => 'required|date_format:d-m-Y|before:"now -15 year"',
        'email' => 'email|required|max:255|unique:candidates,email'

    ];

    public static function rules($id)
    {

        switch (Request::method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'photo_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'first_name' => 'required|min:3|max:50',
                    'last_name' => 'required|min:3|max:50',
                    'gender' => 'required|in:MALE,FEMALE,OTHERS',
                    'dob' => 'required|before:"now -15 year"',//|date_format:d-M-
                    'photo_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'email' => 'email|required|max:255|unique:candidates,email,' . $id . ',id'

                ];
            }
            default:
                break;
        }
    }

    public static $messages = [
        'dob.before' => 'Date of Birth must be minimum 15 year old',
        'photo_url.required' => 'You must upload your Photo',
        'photo_url.mimes' => 'The Profile Photo Must be a valid JPG',
        'photo_url.max' => 'The Photo size should be maximum of 512KB',
        'cv_url.required' => 'You must upload your CV/Resume',
        'cv_url.mimes' => 'The CV/Resume must be in any one of the formats as specified (PDF/DOC/DOCX)',
        'cv_url.max' => 'The CV/Resume size should be maximum of 1MB or 1024KB',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $gender = [
        'MALE' => 'MALE',
        'FEMALE' => 'FEMALE',
        'OTHERS' => 'OTHERS'
    ];

    public static $religion = [
        'BUDDHISM' => 'BUDDHISM',
        'CHRISTIANITY' => 'CHRISTIANITY',
        'HINDUISM' => 'HINDUISM',
        'ISLAM' => 'ISLAM',
        'JAINISM' => 'JAINISM',
        'PARSI' => 'PARSI',
        'SIKHISM' => 'SIKHISM',
        'OTHERS' => 'OTHERS'
    ];

    public static $marital = [
        'UNMARRIED' => 'UNMARRIED',
        'MARRIED' => 'MARRIED',
        'DIVORCEE' => 'DIVORCEE',
        'WIDOW' => 'WIDOW'
    ];

    public static function registerCandidate($input = array())
    {
        return Candidate::create([
            'name' => $input['name'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'mobile_num' => $input['mobile_num'],
            'password' => bcrypt($input['password']),
        ]);
    }

    public function bio()
    {
        return $this->hasOne(CandidateInfo::class, 'candidate_id');
    }

    public function education()
    {
        return $this->hasMany(CandidateEduDetails::class, 'candidate_id');
    }

    public function educations()
    {
        return $this->hasMany(EduDetails::class, 'candidate_id');
    }

    public function experience()
    {
        return $this->hasMany(CandidateExpDetails::class, 'candidate_id');
    }

    public function language()
    {
        return $this->hasMany(CandidateLanguageInfo::class, 'candidate_id');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'candidate_id');
    }

    public function professionals()
    {
        return $this->hasMany(ProfessionalSkill::class, 'candidate_id');
    }

    public function accomplishments()
    {
        return $this->hasMany(Accomplishment::class, 'candidate_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function verified()
    {
        $this->verified_status = 'verified';
        $this->status = 1;
        $this->confirmation_code = null;
        $this->save();
    }

    public function setEmailAttribute($value)
    {
        $email = $this->name;
        return $this->attributes['email'] = ($value == $email . '@gmail.com') ? '' : $value;
    }

    public function image()
    {

        if (!empty($this->photo_url) && File::exists(public_path($this->photo_url)))

            return 'images/image.php?id=' . $this->photo_url;

        return 'images/missing.png';

    }

    public function getDates()
    {
        return ['created_at', 'updated_at', 'dob'];
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = date('Y-m-d', strtotime($value));
    }

    public function getDobAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->format('d-M-Y');
    }

}
