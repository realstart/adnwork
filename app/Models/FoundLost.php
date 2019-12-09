<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoundLost extends Model
{
    protected $fillable =[
        'user_id',
        'poster_id',
        'item_sel',
        'item_name',
        'item_value',        
        'item_date',        
        'item_location',
    ];
}
