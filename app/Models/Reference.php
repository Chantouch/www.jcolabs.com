<?php

namespace App\Models;

use App\Model\frontend\Candidate;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = [
        'candidate_id', 'company_name', 'email', 'first_name',
        'last_name', 'phone_number', 'position',
    ];

    public static function rules()
    {
        return [
            'company_name' => 'required',
            'phone_number' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'phone_number.required' => 'Please input his phone number'
        ];
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
