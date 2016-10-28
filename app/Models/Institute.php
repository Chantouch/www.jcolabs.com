<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class Institute
 * @package App\Models
 * @version October 23, 2016, 10:41 am UTC
 */
class Institute extends Model
{
    use SoftDeletes;

    public $table = 'institutes';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'contact_name',
        'email',
        'mobile_no',
        'address',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'contact_name' => 'string',
        'email' => 'string',
        'mobile_no' => 'string',
        'address' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::upper($value);
    }


}
