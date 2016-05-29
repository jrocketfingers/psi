<?php

namespace App\Http\Controllers;

use App\Repositories\StudentRepository;
use App\Student;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class StudentsController extends Controller
{
    public function __construct() {
        $this->middleware('assistant');
    }

    public function getAll() {
        $students = Student::all();

        return view('students.index', [
            'students' => $students,
        ]);
    }

    public function getByRole($role_id) {
        $students = StudentRepository::getByRole($role_id);

        return view('students.index', [
           'students' => $students
        ]);
    }
    
    public function show($student_id) {
        $student = Student::find($student_id);
        return view('students.details', [
            'student' => $student,
        ]);
    }
}
