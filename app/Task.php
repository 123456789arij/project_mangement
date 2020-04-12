<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }
}
