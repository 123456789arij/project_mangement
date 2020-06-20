<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $hidden = ['pivot'];

    public function messages()
    {
        return $this->hasMany(DiscussionMessage::class);
    }

    public function users()
    {
        return $this->belongsToMany(Employee::class, 'discussion_participants')->withPivot('closed')->withTimestamps();
    }

    public function fillExtraFields($user_id){
        $this->contact = $this->users()->wherePivot('employee_id','!=',$user_id)->select('employees.*')->first();
        //$this->contact->relationship = fetchRelationNH($this->contact->id, $relations);

        $this->last_message = $this->messages()->orderBy('created_at', 'DESC')->first();
    }


}
