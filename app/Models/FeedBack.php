<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    protected $table = 'feed_back';
    protected $fillable = [
        'name', 'email', 'avatar', 'avatar', 'description', 'status', 'facebook', 'linkedin', 'twitter'
    ];

    public static function rules()
    {
        return [
            'name' => 'required|max:200',
            'email' => 'required|unique,email:feed_back',
            'avatar' => 'required',
            'description' => 'required|max:2000',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
        ];
    }

    public static function messages()
    {
        return [
            'name.required' => 'required|max:200',
            'email.required' => 'required|unique,email:feed_back',
            'avatar.required' => 'required',
            'description.required' => 'required|max:2000',
            'facebook.required' => 'required',
            'linkedin.required' => 'required',
            'twitter.required' => 'required',
        ];
    }
}
