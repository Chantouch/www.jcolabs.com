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
        'name', 'email', 'phone', 'subject', 'message', 'cv'
    ];

    /**
     * @return array
     */
    public static function rule()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required|max:700',
            'cv' => 'required|mimes:jpg,jpeg,png,bmp,wbmp|max:2048',
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
            'cv.required' => 'required|mimes:jpg,jpeg,png,bmp,wbmp|max:2048',
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
}
