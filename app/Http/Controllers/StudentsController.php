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
        $students = StudentRepository::getAll();

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
        $user = User::find($student_id);
        $student = Student::find($student_id);
        $team = null;
        if($student->team_id) {
            $team = Team::find($student->team_id);
        }
        return view('students.details', [
            'user' => $user,
            'team' => $team,
        ]);
    }
}
