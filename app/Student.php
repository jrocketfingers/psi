<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];

    public static function isStudent($id) {
        $student = Student::find($id);
        if($student) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAll() {
        $students = User::join('students', 'users.id', '=', 'students.id')
                            ->get();
        return $students;
    }

    public static function getByRole($role_id) {
        $students = User::join('students', 'users.id', '=', 'students.id')
            ->join('students_roles', 'students.id', '=', 'students_roles.student_id')
            ->where('students_roles.role_id', '=', $role_id)
            ->groupBy('students.id')
            ->get();
        return $students;
    }
    
    public function user() {
        return $this->morphOne('App\User', 'userable');
    }
}
