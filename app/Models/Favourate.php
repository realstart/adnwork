<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourate extends Model
{
    protected $fillable = [
        'user_id',
        'ads_id',
    ];
}
