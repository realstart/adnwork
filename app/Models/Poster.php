<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $guarded = [];

    public function getcategory()
    {
        return $this->hasMany('App\Models\PosterCategory');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country','country');
    }

    public function getcategoryname()
    {
        return $this->belongsTo('App\Models\Post_Category','category_id');
    }
}
