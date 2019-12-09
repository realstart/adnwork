<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $fillable = [
        'user_id',
        'poster_id',
        'checked',
        'name',
        'default',
    ];
}
