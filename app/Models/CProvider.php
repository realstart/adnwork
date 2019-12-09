<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CProvider extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'poster_id',
        'name',
    ];
}
