<?php 
namespace App\Repositories;

use App\User;

class StudentRepository {
    public static function getByRole($role_id) {
        $students = User::join('students', 'users.id', '=', 'students.user_id')
            ->join('student_role', 'students.user_id', '=', 'student_role.student_id')
            ->where('student_role.role_id', '=', $role_id)
            ->groupBy('students.id')
            ->get();
        return $students;
    }

    public static function getAll() {
        $students = User::join('students', 'users.id', '=', 'students.user_id')
            ->get();
        return $students;
    }
}

?>