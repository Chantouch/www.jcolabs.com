<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App\Models
 * @version November 1, 2016, 9:33 am ICT
 */
class Category extends Model
{
    use Sluggable;
    use SoftDeletes;

    public $table = 'categories';


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


    public function jobs()
    {
        return $this->hasMany(PostedJob::class);
    }


    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brands_categories');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['seo_url'],
            ]
        ];
    }

    /**
     * @param string $value
     * @return string
     */
    public function getSeoUrlAttribute($value = '')
    {
        return $this->name;
    }
}
