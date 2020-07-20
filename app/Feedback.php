<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = ['text_feedback','date_feedback'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
