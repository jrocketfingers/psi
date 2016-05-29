<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\Team;
use App\Role;
use App\StudentRole;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collections;

use App\Http\Requests;

class StudentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($id = null)
    {
        $teams = Team::all();

        return view('students.index', [
            'teams' => $teams,
        ]);
    }

    public function edit($id)
    {
        $student = Student::find($id);
        $personal_roles = array_column($student->roles->toArray(), 'name', 'id');
        $roles = array_column(Role::all()->toArray(), 'name', 'id');

        
        $missing_roles = array_diff($roles, $personal_roles);
        
        return view('students.edit', [
            'student' => $student,
            'missing_roles' => $missing_roles,
            'personal_roles' => $personal_roles,
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $id = Auth::user()->id;

        $student = Student::with('user')->where('user_id', '=', $id)->firstOrFail();


        $student->user->update($request->all());

        $new_roles = Role::all()->only($request['add_role_id']);
        $removed_roles = Role::all()->only($request['delete_role_id']);


        $student->roles()->sync($student->roles->diff($removed_roles)->merge($new_roles));

        return redirect()->action('StudentsController@show', [$id]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = RolesRepository::getByStudentId($id);
        $student = Student::with('user')->find($id);
        return view('students.show', [
            'student' => $student,
            'roles' => $roles,
        ]);
    }
}
