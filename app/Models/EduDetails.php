<?php

namespace App\Models;

use App\Model\frontend\Candidate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class EduDetails extends Model
{
    use SoftDeletes;
    protected $table = 'edu_details';
    protected $guarded = ['_method', '_token'];
    protected $dates = ['start_date', 'end_date'];
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
            'HS' => 'High School or equivalent',
            'VT' => 'Vocational training',
            'DIPLO' => 'Certification (Diploma)',
            'BA' => 'Bachelor degree',
            'MBA' => 'Master degree',
            'PHD' => 'PhD degree',

        ];
    }

    public static function clean($string)
    {
        $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '_', $string); // Removes special chars.

        return preg_replace('/-+/', '_', $string); // Replaces multiple hyphens with single one.
    }

    public function getStartDateAttribute()
    {
        return $this->attributes['start_date'] = Carbon::parse($this->attributes['start_date'])->format('Y-m-d');
    }

    public function getEndDateAttribute()
    {
        return $this->attributes['end_date'] = Carbon::parse($this->attributes['end_date'])->format('Y-m-d');
    }


}
