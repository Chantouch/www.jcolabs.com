<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class ApplyJob extends Model
{
    /**
     * @var string
     */
    protected $table = 'apply_jobs';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'cv', 'job_id'
    ];

    /**
     * @return array
     */
    public static function rule()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required|max:100',
            'message' => 'required|max:700',
            'cv' => 'required|mimes:pdf,doc,docx|max:1024000',
        ];
    }

    public static function message()
    {
        return [
            'name.required' => 'required',
            'email.required' => 'required',
            'phone.required' => 'required',
            'subject.required' => 'required',
            'message.required' => 'required|max:700',
            'cv.required' => 'required|mimes:pdf,doc,docx|max:1024000',
        ];
    }

    /**
     * @var array
     */
    protected $guarded = [
        'id',
        '_token',
        '_method'
    ];

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = ($value == '+855') ? '' : $value;
    }
}
