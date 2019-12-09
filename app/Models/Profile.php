<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function subprofile()
    {
        return $this->hasMany('App\Models\Subprofile','parent_id')->orderBy('name', 'asc');
    }
}
