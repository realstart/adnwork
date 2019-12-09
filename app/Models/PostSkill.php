<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostSkill extends Model
{
    protected $fillable =[
        'user_id',
        'poster_id',
        'skill_name',
        'skill_exp',
        'skill_level',        
    ];
}
