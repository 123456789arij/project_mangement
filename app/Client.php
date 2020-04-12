<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

}
