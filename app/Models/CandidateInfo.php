<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use File;
use Request;

class CandidateInfo extends Model
{
    protected $table = 'candidate_info';

    public static $rules = [
        //'candidate_id' =>'exists:members,id',
        'first_name' => 'required|min:3|max:50',
        'last_name' => 'required|min:3|max:50',
        'sex' => 'required|in:MALE,FEMALE,OTHERS',
        'dob' => 'required|date_format:d-m-Y|before:"now -15 year"',
        'photo_url' => 'required|mimes:jpeg,png|max:512',
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
                    'sex' => 'required|in:MALE,FEMALE,OTHERS',
                    'dob' => 'required|date_format:d-m-Y|before:"now -15 year"',
                    'photo_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'email' => 'email|required|max:255|unique:candidates,email,' . $id . ',id'

                ];
            }
            default:
                break;
        }
    }


    public static function getValidationRules($rules = '')
    {
        if ($rules == 'update') {
            return
                [
                    'full_name' => 'required|min:3|max:50',
                    'spouse_name' => 'max:50',
                    'sex' => 'required|in:MALE,FEMALE,OTHERS',
                    'religion' => 'required|in:BUDDHISM,CHRISTIANITY,HINDUISM,ISLAM,JAINISM,PARSI,SIKHISM,OTHERS',
                    'marital_status' => 'required|in:UNMARRIED,MARRIED,DIVORCEE,WIDOW',
                    'dob' => 'required|date_format:d-m-Y|before:"now -15 year"',
                    'address' => 'max:255',
                    'city_id' => 'required|exists:cities,id',
                    'district_id' => 'required|exists:districts,id',
                    'pin_code' => 'numeric|digits_between:5,6',
                    'physical_height' => 'numeric',
                    'physical_weight' => 'numeric',
                    'photo_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'cv_url' => 'mimes:pdf,doc,docx|max:102400',
                    'proof_details_id' => 'exists:proof_residenses,id',
                    'proof_no' => 'max:100',
                    'relocated' => 'required|in:No,Within City,Within Country,Outside Country',
                    'additional_info' => 'max:255',
                ];
        } else {
            return $rules;
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

    protected $guarded = ['id', '_token'];

    protected $fillable = [
        'candidate_id', 'full_name',
        'spouse_name', 'sex',
        'religion', 'marital_status', 'dob',
        'address', 'city_id', 'district_id',
        'pin_code', 'physical_height',
        'physical_weight', 'photo_url', 'cv_url',
        'proof_details_id', 'proof_no',
        'relocated', 'additional_info'
    ];

    public static $sex_options = [
        'MALE' => 'MALE',
        'FEMALE' => 'FEMALE',
        'OTHERS' => 'OTHERS'
    ];

    public static $religion_options = [
        'BUDDHISM' => 'BUDDHISM',
        'CHRISTIANITY' => 'CHRISTIANITY',
        'HINDUISM' => 'HINDUISM',
        'ISLAM' => 'ISLAM',
        'JAINISM' => 'JAINISM',
        'PARSI' => 'PARSI',
        'SIKHISM' => 'SIKHISM',
        'OTHERS' => 'OTHERS'
    ];

    public static $marital_status_options = [
        'UNMARRIED' => 'UNMARRIED',
        'MARRIED' => 'MARRIED',
        'DIVORCEE' => 'DIVORCEE',
        'WIDOW' => 'WIDOW'
    ];

    public static $relocated_options = [
        'No' => 'No',
        'Within City' => 'Within City',
        'Within Country' => 'Within Country',
        'Outside Country' => 'Outside Country'
    ];

    protected function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = Str::upper($value);
    }

    protected function setSpouseNameAttribute($value)
    {
        $this->attributes['spouse_name'] = Str::upper($value);
    }

    protected function setDobAttribute($value)
    {
        $this->attributes['dob'] = date('Y-m-d', strtotime($value));
    }

    protected function getDobAttribute($value)
    {
        return $this->attributes['dob'] = date('d-m-Y', strtotime($value));
    }

    protected function getPinCodeAttribute($value)
    {
        return $this->attributes['pin_code'] = ($value == '0') ? '' : $value;
    }

    protected function getPhysicalHeightAttribute($value)
    {
        return $this->attributes['physical_height'] = ($value == '0.00') ? '' : $value;
    }

    protected function getPhysicalWeightAttribute($value)
    {
        return $this->attributes['physical_weight'] = ($value == '0.00') ? '' : $value;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function image()
    {

        if (!empty($this->photo_url) && File::exists(public_path($this->photo_url)))

            return 'images/image.php?id=' . $this->photo_url;

        return 'images/missing.png';

    }
}
