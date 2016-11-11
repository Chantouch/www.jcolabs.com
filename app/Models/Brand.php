<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = ['name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brands_categories');
    }
}
