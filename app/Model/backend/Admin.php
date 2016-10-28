<?php

namespace App\Model\backend;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile_no',
        'email',
        'password',
        'email_token',
        'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $guarded = ['_token', 'name'];

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    public static $rules = [
        'name' => 'required|between:3,100',
        'mobile_no' => 'required|digits:10|numeric|unique:admins,mobile_no',
        'email' => 'email|required|max:100|unique:admins,email',
        'password' => 'confirmed|required',
    ];

    public static $messages = [
        'name.min' => 'Name must be at least minimum 3 characters',
        'mobile_no.numeric' => 'Mobile No can only contain numbers',
        'password.confirmed' => 'Password and Confirm Password does not match',
    ];

    public function verified()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }

}
