<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class StudentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getAll() {
        $students = Student::getAll();

        return view('students.index', [
            'students' => $students,
        ]);
    }

    public function getByRole($role_id) {
        $students = Student::getByRole($role_id);

        return view('students.index', [
           'students' => $students
        ]);
    }
}
