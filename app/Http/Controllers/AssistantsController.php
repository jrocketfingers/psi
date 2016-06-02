<?php

namespace App\Http\Controllers;

use App\Student;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;

class AssistantsController extends Controller
{
    public function __construct() {
        $this->middleware('assistant');
    }

    public function index($id = null) {
        return view('assistants.home');
    }

    public function getAllStudents() {
        $students = Student::all();

        return view('assistants.showAllStudents')->with('students', $students);
    }

    public function showStudentDetails($id) {
        $student = Student::find($id);

        return view('assistants.showStudentDetails')->with('student', $student);
    }

    public function getAllTeams() {
        $teams = Team::all();

        return view('assistants.showAllTeams')->with('teams', $teams);
    }

    public function showTeamDetails($id){
        $team = Team::find($id);

        return view('assistants.showTeamDetails')->with('team', $team);
    }
}
