<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_Category extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'slug',
    ];

    public function subcategory()
    {
        return $this->hasMany('App\Models\Post_SubCategory','parent_id')->orderBy('name', 'asc');
    }
    public function poster()
    {
        return $this->hasMany('App\Models\Poster','parent_id');
    }
}
