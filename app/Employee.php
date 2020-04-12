<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    public function department()
    {
        return $this->belongsTo('App\Department');
    }


    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

}
