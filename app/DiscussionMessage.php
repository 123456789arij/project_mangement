<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionMessage extends Model
{
    protected $fillable = ['content', 'sender_id', 'receiver_id', 'read', 'created_at', 'updated_at'];

    protected $hidden = [];

    public function sender()
    {
        return $this->belongsTo(Employee::class,'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'receiver_id');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
}
