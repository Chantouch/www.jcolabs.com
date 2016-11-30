<?php

namespace App\Models;

use App\Model\frontend\Candidate;
use Illuminate\Database\Eloquent\Model;

class ProfessionalSkill extends Model
{

    protected $table = 'profession_skill';

    protected $fillable = [
        'candidate_id', 'level', 'name', 'year_experience'
    ];

    public static function rule()
    {
        return [
            'name' => 'required'
        ];
    }

    public static function message()
    {
        return [
            'name.required' => 'Please fill your professional skill name'
        ];
    }


    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

}
