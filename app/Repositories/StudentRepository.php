<?php 
namespace App\Repositories;

use App\User;

class StudentRepository {
    public static function getByRole($role_id) {
        $students = User::join('students', 'users.id', '=', 'students.id')
            ->join('students_roles', 'students.id', '=', 'students_roles.student_id')
            ->where('students_roles.role_id', '=', $role_id)
            ->groupBy('students.id')
            ->get();
        return $students;
    }

    public static function getAll() {
        $students = User::join('students', 'users.id', '=', 'students.id')
            ->get();
        return $students;
    }
}

?>