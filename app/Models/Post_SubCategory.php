<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_SubCategory extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function parentcategory()
    {
        return $this->belongsTo('App\Models\Post_Category','parent_id');
    }
    public function poster()
    {
        return $this->hasMany('App\Models\Poster','sub_parent_id');
    }
}
