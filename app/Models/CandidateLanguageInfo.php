<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateLanguageInfo extends Model
{
    protected $table = 'candidate_language_info';

    protected $guarded = ['_method', 'token'];

    public static $rules = [
        'name' => 'required|max:50'
    ];

    public static function level()
    {
        return [
            'b' => 'Beginner',
            'c' => 'Conversation',
            'd' => 'Business',
            'e' => 'Fluent',
            'f' => 'Mother Tongue'
        ];
    }
}

