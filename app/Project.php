<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }


    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }
}
