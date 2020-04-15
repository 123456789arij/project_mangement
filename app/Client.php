<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name','email', 'password', 'mobile' , 'adsress' , 'linked_in' , 'skype' , 'facebook','user_id',
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
