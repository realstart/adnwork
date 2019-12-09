<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosterCategory extends Model
{
    protected $fillable = [
        'poster_id',
        'parent_id',
        'subparent_id',
        'user_id',
    ];
    public function getposter()
    {
        return $this->belongsTo('App\Models\Poster','poster_id');
    }
    public function getcategory()
    {
        return $this->belongsTo('App\Models\Post_Category','parent_id');
    }
    public function getsubcategory()
    {
        return $this->belongsTo('App\Models\Post_SubCategory','subparent_id');
    }
    public function getuser()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
