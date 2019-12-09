<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'title',
        'content',
        'sender',
        'receiver',
        'status',
        'attachment',
        'filename',
        'name',
        'email',
        'post_id',
        'accept_status',
        'del_s',        
        'del_r',        
    ];

    public function user()
    {
        return $this->belongsTo('App\User','sender');
    }
}
