<?php

namespace App\Http\Controllers;

use App\Assistant;
use App\Image;
use App\Role;
use App\Student;
use App\Team;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    
    public function showRole($id) {
        $role = Role::find($id);

        return view('assistants.showRole', [
            'role' => $role,
        ]);
    }

    public function showTeamDetails($id){
        $team = Team::find($id);

        return view('assistants.showTeamDetails')->with('team', $team);
    }

    public function showDetails() {
        $assistant = Assistant::find(Auth::user()->id);

        return view('assistants.show', [
            'assistant' => $assistant,
        ]);

    }
    
    public function editDetails() {
        return view('assistants.edit');
    }

    public function updateDetails(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'image' => 'mimes:gif'
        ]);
        
        if($validator->fails()) {
            return redirect()->action('AssistantsController@editDetails')
                ->withErrors($validator)
                ->withInput();
        }

        return $request->all();
        $file = $request->file('image');
        return $file;

        if($file != null) {
            $image = new Image();
            //$image->image = $file->
        }

        $assistant = Assistant::find(Auth::user()->id);
        $assistant->user->name = $request->input('name');
        $assistant->user->email = $request->input('email');
        $assistant->save();

        return view('assistants.show');
    }
}
