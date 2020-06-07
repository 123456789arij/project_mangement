<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body','employee_id', 'task_id',
    ];


    public function commentable()
    {
        return $this->morphTo();
    }

/*    public function user()
    {
        return $this->belongsTo(User::class);
    }*/
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
