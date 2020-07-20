<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title','start','end','description','color',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
