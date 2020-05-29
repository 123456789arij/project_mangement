<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'project_id', 'start_date', 'end_date', 'description', 'priority', 'status',
    ];

    const STATUS = ['Completed' => 1, 'Incomplete' => 2, 'In Progress' => 3];

    protected $appends = ["open", "text"];

    public function getOpenAttribute()
    {
        return true;
    }

    public function getTextAttribute()
    {
        return $this->title;
    }

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
