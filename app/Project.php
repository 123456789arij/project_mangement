<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'client_id', 'category_id', 'start_date', 'deadline', 'status', 'description', 'progress_bar',
    ];
    const STATUS = ['not Started' => 1, 'on Hold' => 2, 'In Progress' => 3, 'canceled' => 4, 'finished' => 5];


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
    public function feeds()
    {
        return $this->morphMany('App\Feed', 'feedable');
    }
}
