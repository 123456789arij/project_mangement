<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guard = 'client';

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'address', 'linked_in', 'skype', 'facebook', 'user_id',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

}
