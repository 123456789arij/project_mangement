<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = [
        'path', 'fileable'
    ];


    public function fileable()
    {
        return $this->morphTo();
    }
}
