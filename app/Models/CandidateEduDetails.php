<?php

namespace App\Models;

use App\Model\frontend\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CandidateEduDetails extends Model
{
    protected $table = 'candidate_edu_details';

    protected $guarded = ['_method', '_token'];

    protected $fillable = [
        'city_id',
        'country_name',
        'candidate_id',
        'degree_level',
        'description',
        'end_date',
        'grade',
        'is_studying',
        'field_of_study',
        'school_university_name',
        'start_date',
    ];

    public static $rules = [
        'degree_level' => 'required',
        'start_date' => 'required',
        'school_university_name' => 'required',
        'country_name' => 'required|max:50',
        'city_id' => 'required',
        'field_of_study' => 'required',
    ];

    public static function rules(Request $request)
    {

        $rules = [
            'degree_level' => 'required',
            'start_date' => 'required',
            'school_university_name' => 'required',
            'country_name' => 'required|max:50',
            'city_id' => 'required',
            'field_of_study' => 'required',
        ];

        foreach ($request->get('school_university_name') as $key => $val) {
            $rules['school_university_name.' . $key] = 'required|max:150';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->request->get('items') as $key => $val) {
            $messages['items.' . $key . '.max'] = 'The field labeled "Book Title ' . $key . '" must be less than :max characters.';
        }
        return $messages;
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public static function degree_level()
    {
        return [
            '1' => 'High School or equivalent',
            '2' => 'Vocational training',
            '3' => 'Certification (Diploma)',
            '4' => 'Bachelor\'s degree',
            '5' => 'Master\'s degree',
            '6' => 'PhD\'s degree',

        ];
    }
}
