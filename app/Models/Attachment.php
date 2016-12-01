<?php

namespace App\Models;

use App\Model\frontend\Candidate;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    protected $table = 'attachments';

    protected $fillable = [
        'name', 'file', 'candidate_id'
    ];

    public static function rules()
    {
        return [
            'name' => 'required',
            'file' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'Please input name of attachment'
        ];
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
