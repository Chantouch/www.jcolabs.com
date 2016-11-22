<?php

namespace App\Model\frontend;

use App\Models\CandidateEduDetails;
use App\Models\CandidateExpDetails;
use App\Models\CandidateInfo;
use App\Models\CandidateLanguageInfo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


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
        'name', 'email', 'confirmation_code',
        'password', 'mobile_num', 'github_id',
        'first_name', 'last_name', 'avatar',
        'verified_status', 'temp_enrollment_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
        //returns $this->hasMany('Photo')->where('photos.type', '=', 'Cars');
    }

    public function experience()
    {
        return $this->hasMany(CandidateExpDetails::class, 'candidate_id');
    }

    public function language()
    {
        return $this->hasMany(CandidateLanguageInfo::class, 'candidate_id');
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

}
