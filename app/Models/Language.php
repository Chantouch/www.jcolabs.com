<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 * @package App\Models
 * @version October 23, 2016, 11:00 am UTC
 */
class Language extends Model
{
    use SoftDeletes;

    public $table = 'languages';


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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posted_job()
    {
        return $this->belongsToMany(PostedJob::class,'language_posted_job', 'posted_job_id', 'language_id')->withPivot('posted_job_id', 'language_id')->withTimestamps();
    }


}
