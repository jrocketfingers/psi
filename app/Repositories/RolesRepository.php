<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RolesRepository {
    public static function geByStudentId($student_id)
    {
        $roles = DB::table('students_roles')
            ->where('students_roles.student_id', '=', $student_id)
            ->join('roles', 'students_roles.role_id', '=', 'roles.id')
            ->get();

        return $roles;
    }
}

?>