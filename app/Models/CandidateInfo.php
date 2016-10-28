<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use File;

class CandidateInfo extends Model
{
    protected $table  =   'candidate_info';
    public static $rules = [
        //'candidate_id' =>'exists:members,id',
        'full_name' => 'required|min:3|max:50',
        'spouse_name' => 'max:50',
        'sex' => 'required|in:MALE,FEMALE,OTHERS',
        'religion' => 'required|in:BUDDHISM,CHRISTIANITY,HINDUISM,ISLAM,JAINISM,PARSI,SIKHISM,OTHERS',
        'marital_status' => 'required|in:UNMARRIED,MARRIED,DIVORCEE,WIDOW',
        'dob' => 'required|date_format:d-m-Y|before:"now -15 year"',
        'physical_challenge' => 'required|in:YES,NO',
        'address' => 'max:255',
        'state_id' => 'required|exists:states,id',
        'district_id' => 'required|exists:districts,id',
        'pin_code' => 'numeric|digits_between:6,6',
        'physical_height' => 'numeric',
        'physical_weight' => 'numeric',
        'physical_chest' => 'numeric',
        'photo_url' => 'required|mimes:jpeg,png|max:512',
        'cv_url' => 'required|mimes:pdf,doc,docx|max:102400',
        'proof_details_id' => 'required|exists:proof_details,id',
        'proof_no' => 'max:100',
        'relocated' => 'required|in:No,Within State,Within Country,Outside Country',
        'additional_info' => 'max:255',

    ];


    public static function getValidationRules($rules = '')
    {
        if ($rules == 'update') {
            return
                [
                    'full_name' => 'required|min:3|max:50',
                    'spouse_name' => 'max:50',
                    'sex' => 'required|in:MALE,FEMALE,OTHERS',
                    'caste_id' => 'required|exists:casts,id',
                    'religion' => 'required|in:BUDDHISM,CHRISTIANITY,HINDUISM,ISLAM,JAINISM,PARSI,SIKHISM,OTHERS',
                    'marital_status' => 'required|in:UNMARRIED,MARRIED,DIVORCEE,WIDOW',
                    'dob' => 'required|date_format:d-m-Y|before:"now -15 year"',
                    'physical_challenge' => 'required|in:YES,NO',
                    'address' => 'max:255',
                    'state_id' => 'required|exists:states,id',
                    'district_id' => 'required|exists:districts,id',
                    'pin_code' => 'numeric|digits_between:6,6',
                    'physical_height' => 'numeric',
                    'physical_weight' => 'numeric',
                    'physical_chest' => 'numeric',
                    'photo_url' => 'mimes:jpeg,png|max:512',
                    'cv_url' => 'mimes:pdf,doc,docx|max:102400',
                    'proof_details_id' => 'required|exists:proof_details,id',
                    'proof_no' => 'max:100',
                    'relocated' => 'required|in:No,Within State,Within Country,Outside Country',
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

    protected $fillable = ['candidate_id', 'full_name', 'spouse_name', 'sex', 'caste_id', 'religion', 'marital_status', 'dob',
        'physical_challenge', 'address', 'city_id', 'district_id', 'pin_code', 'physical_height', 'physical_weight',
        'physical_chest', 'photo_url', 'cv_url', 'proof_details_id', 'proof_no', 'relocated', 'additional_info'
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

    protected function getPhysicalChestAttribute($value)
    {
        return $this->attributes['physical_chest'] = ($value == '0.00') ? '' : $value;
    }

    // public function state()
    // {
    //     return $this->belongsTo('employment_bank\Models\State', 'state_id');
    // }

    public function district()
    {
        return $this->belongsTo('employment_bank\Models\District', 'district_id');
    }

    public function image()
    {

        if (!empty($this->photo_url) && File::exists(storage_path($this->photo_url)))
            return 'images/image.php?id=' . $this->photo_url;

        return 'images/missing.png';
    }
}
