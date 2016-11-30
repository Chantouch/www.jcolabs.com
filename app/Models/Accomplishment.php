<?php

namespace App\Models;

use App\Model\frontend\Candidate;
use Illuminate\Database\Eloquent\Model;

class Accomplishment extends Model
{
    protected $fillable = [
        'candidate_id', 'date', 'description', 'title',
    ];

    public static function rules()
    {
        return [
            'title' => 'required',
            'date' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'date.required' => 'Please input your get date'
        ];
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
