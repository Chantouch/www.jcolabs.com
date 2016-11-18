<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subject
 * @package App\Models
 * @version October 23, 2016, 10:13 am UTC
 */
class Subject extends Model
{
    use SoftDeletes;

    public $table = 'subjects';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
