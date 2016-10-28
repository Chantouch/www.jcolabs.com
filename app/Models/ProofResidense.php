<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProofResidense
 * @package App\Models
 * @version October 24, 2016, 7:57 am UTC
 */
class ProofResidense extends Model
{
    use SoftDeletes;

    public $table = 'proof_residenses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
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
