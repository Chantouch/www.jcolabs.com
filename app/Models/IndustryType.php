<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class IndustryType
 * @package App\Models
 * @version October 23, 2016, 3:03 pm UTC
 */
class IndustryType extends Model
{
    use SoftDeletes;

    public $table = 'industry_types';


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

    public function setNameAttributes($value)
    {
        return $this->attributes['name'] = Str::upper($value);
    }

    public function Jobs()
    {
        return $this->belongsTo(PostedJob::class);
    }


}
