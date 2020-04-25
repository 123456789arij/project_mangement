<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $guard = 'employee';

    protected $fillable = [
        'name','email', 'password','role','gender','skills','image','address','joining_date','department_id','mobile',
    ];

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
