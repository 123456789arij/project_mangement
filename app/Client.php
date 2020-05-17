<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    protected $guard = 'client';

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'adsress', 'linked_in', 'skype', 'facebook', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

}
