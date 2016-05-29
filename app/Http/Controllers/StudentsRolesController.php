<?php

namespace App\Http\Controllers;

use App\Repositories\RolesRepository;
use App\Role;
use App\StudentRole;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class StudentsRolesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($student_id) {
        $roles = RolesRepository::getByStudentId($student_id);

        return view('students_roles.index', [
            'roles' => $roles,
        ]);
    }

    public function create() {
        $roles = Role::all();

        return view('students_roles.create', [
            'roles' => $roles,
        ]);
    }
    
    public function store(Request $request) {
        $student_id = Auth::user()->id;
        $role_id = $request->input('sel');

        if(StudentRole::doesExist($student_id, $role_id)) {
            return redirect()->action('StudentsRolesController@create');
        }

        StudentRole::create([
            'student_id' => $student_id,
            'role_id' => $role_id,
        ]);

        return redirect()->action('StudentsRolesController@index',[$student_id]);
    }
    
    public function destroy($role_id) {
        $student_id = Auth::user()->id;

        StudentRole::removeRole($student_id, $role_id);
        
        return redirect()->action('StudentsRolesController@index',[$student_id]);
    }
}
