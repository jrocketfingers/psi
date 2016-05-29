<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id', 'team_id', 'is_leader'
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
        return $this->belongsToMany('App\Role', 'student_role');
    }
    public function team() {
        return $this->belongsTo('App\Team');
    }
}
