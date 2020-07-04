<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Employee extends Authenticatable
{
    use Notifiable;

    protected $guard = 'employee';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'gender', 'skills', 'image', 'address', 'joining_date', 'department_id', 'mobile', 'specialty'
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function discussions()
    {
        return $this->belongsToMany(Discussion::class, 'discussion_participants')->withPivot('closed')->withTimestamps();
    }

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

    public function destroyDiscussion($user_id)
    {
        $discussion = $this->discussions()->where('name', '=', $this->id < $user_id ? $this->id . '-' . $user_id : $user_id . '-' . $this->id)->first();

        if ($discussion) {
            $discussion->messages()->delete();
            $discussion->users()->detach();
            $discussion->delete();
        }
    }

    public function countMyUnreadDiscussions()
    {
        return count(DB::select("
          select discussions.id from `discussions`
          inner join `discussion_participants` on `discussions`.`id` = `discussion_participants`.`discussion_id`
          right join `discussion_messages` on `discussions`.`id` = `discussion_messages`.`discussion_id`
          where `discussion_participants`.`employee_id` = $this->id
            and `discussion_participants`.`closed` = 0
            and `discussion_messages`.`read` = 0
            and `discussion_messages`.`receiver_id` = $this->id
            group by `discussions`.`id`"));
    }

    public function getOpenDiscussions($iPage = 1)
    {
        // $relations = $this->getRelationsIds();
        $perPage = 10;
        $iPage = (int)$iPage ? abs($iPage) : 1;
        $offset = ($iPage - 1) * $perPage;

        $discussions = $this->discussions()->wherePivot('closed', '=', '0')->orderBy('updated_at', 'DESC')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        foreach ($discussions as $key => &$discussion) {
            $discussion->fillExtraFields($this->id);
        }
        return $discussions;
    }
}
