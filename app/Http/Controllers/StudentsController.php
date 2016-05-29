<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\Team;
use App\Role;
use App\StudentRole;
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
        $student = User::find($id);
        $personal_roles = array_column(RolesRepository::getByStudentId($id), 'name', 'id');
        $roles = array_column(Role::all()->toArray(), 'name', 'id');

        
        $missing_roles = array_diff($roles, $personal_roles);
        /*$missing_roles = collect()->pluck('name', 'id');
        $personal_roles = collect($personal_roles)->pluck('name', 'id');*/

        return view('students.edit', [
            'student' => $student,
            'missing_roles' => $missing_roles,
            'personal_roles' => $personal_roles,
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        $id = $request['id'];

        $student = User::find($id);
        $student->update($request->all());

        $new_roles = Role::all()->only($request['add_role_id']);
        $removed_roles = Role::all()->only($request['delete_role_id']);


        foreach ($removed_roles as $role)
        {
            StudentRole::removeRole($student->id, $role->id);
        }

        foreach ($new_roles as $role)
        {
            StudentRole::create([
                'student_id' => $student->id,
                'role_id' => $role->id,
            ]);
        }
        
        $personal_roles = RolesRepository::getByStudentId($id);

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
        $student = User::find($id);
        return view('students.show', [
            'student' => $student,
            'roles' => $roles,
        ]);
    }
}
