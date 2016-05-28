<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRole extends Model
{
    protected $table = 'students_roles';

    protected $fillable = [
        'student_id', 'role_id', 'isActive'
    ];

    public static function doesExist($student_id, $role_id) {
        $student_role = StudentRole::where('student_id', '=', $student_id)
                                    ->where('role_id', '=', $role_id)
                                    ->first();

        if($student_role === null) {
            return false;
        } else {
            return true;
        }
    }

    public static function removeRole($student_id, $role_id) {
        StudentRole::where('student_id', '=', $student_id)
                    ->where('role_id', '=', $role_id)
                    ->delete();
    }
}
