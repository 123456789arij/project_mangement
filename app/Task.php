<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'titre', 'project_id', 'start_date', 'end_date', 'description', 'priority', 'status',
    ];

    const STATUS = ['Incomplete' => 0, 'Completed' => 1, 'inProgress' => 3];

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
