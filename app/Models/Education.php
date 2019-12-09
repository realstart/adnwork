<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable =[
        'user_id',
        'poster_id',
        'degree',
        'area',
        'years',        
    ];
}
