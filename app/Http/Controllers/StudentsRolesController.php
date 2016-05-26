<?php

namespace App\Http\Controllers;

use App\Role;
use App\StudentRole;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentsRolesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($student_id) {
        $roles = DB::table('students_roles')
                    ->where('students_roles.student_id', '=', $student_id)
                    ->join('roles','students_roles.role_id', '=', 'roles.id')
                    ->get();

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
        $role = Role::where('name','=',$request->input('sel'))->first();

        if(StudentRole::where('role_id', '=', $role->id)->where('student_id', '=', $student_id)->first()) {
            return redirect()->action('StudentsRolesController@create');
        }

        StudentRole::create([
            'student_id' => $student_id,
            'role_id' => $role->id,
        ]);

        return redirect()->action('StudentsRolesController@index',[$student_id]);
    }
    
    public function destroy($role_id) {
        $user_id = Auth::user()->id;

        StudentRole::where('role_id', '=', $role_id)->where('student_id', '=', $user_id)->delete();
        
        return redirect()->action('StudentsRolesController@index',[$user_id]);
    }
}
