<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'name', 'user_id', 'link', 'password'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
