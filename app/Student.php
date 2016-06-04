<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id', 'team_id', 'is_leader',
    ];

    public static function isStudent($id) {
        $student = Student::find($id);
        if($student) {
            return true;
        } else {
            return false;
        }
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function roles() {
        return $this->belongsToMany('App\Role');
    }
    public function team() {
        return $this->belongsTo('App\Team');
    }
    public function notifications() {
        return $this->hasMany('App\Notification');
    }
    public function joins() {
        return $this->hasMany('App\Joins');
    }
    public function invites() {
        return $this->hasMany('App\Invite');
    }
    public function kicks() {
        return $this->hasMany('App\Kick');
    }
    public function leaderChanges() {
        return $this->hasMany('App\LeaderChange');
    }
    public function votesPending() {
        return $this->hasMany('App\Vote');
    }
}
