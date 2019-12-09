<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adn extends Model
{
    protected $fillable = [
        'subject',
        'tagline',
        'link',
        'type',
        'logo',
        'image',
        'body',
        'user_id',
        'location',
        'status',
        'exp_date',
    ];
}
