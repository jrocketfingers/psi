<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RolesRepository {
    public static function geByStudentId($student_id)
    {
        $roles = DB::table('student_role')
            ->where('student_role.student_id', '=', $student_id)
            ->join('roles', 'student_role.role_id', '=', 'roles.id')
            ->get();

        return $roles;
    }
}

?>