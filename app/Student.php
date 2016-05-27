<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id', 'team_id', 'is_leader'
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
        return $this->morphOne('App\User', 'userable');
    }
}
