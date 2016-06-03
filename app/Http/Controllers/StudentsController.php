<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\Team;
use App\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class StudentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($id = null)
    {
       // $teams = Team::all();
        $student = Student::find(Auth::user()->id);

        $roles= $student->roles->sortBy('name');
        $teams = new Collection();
        foreach ($roles as $role) {
            $tmpteams = $role->teams->sortBy('name');
            foreach ($tmpteams as $team) {
               if($student->team != $team) {
                   $teams->push($team);
               }
            }
        }

        if ($teams->isEmpty())
        {
            $teams = Team::all();
        }

        return view('students.index', [
            'teams' => $teams,
            'student' => $student,
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

    public function showTeamCreationForm()
    {
        $roles = array_column(Role::all()->toArray(), 'name', 'id');

        return view('students.team_creation',[
            'roles' => $roles,
        ]);
    }

    public function createTeam(Request $request)
    {
        $id = Auth::user()->id;


        $student = Student::with('user')->where('user_id', '=', $id)->firstOrFail();
        $new_roles = Role::all()->only($request['add_role_id']);

        $team = Team::create($request->all());
        $team->roles()->sync($new_roles);
        $team->save();

        $student->team()->associate($team);
        $student->is_leader = true;
        $student->save();


        return redirect()->action('StudentsController@index', [$id]);
    }

    public function disbandTeam()
    {
        $id = Auth::user()->id;
        $student = Student::find($id);

        if(!$student->is_leader)
        {
            return back()->withInput();
        }

        $student->team->delete();
        $student->is_leader = false;
        $student->save();

        return redirect()->action('StudentsController@index', [$id]);

    }

    public function join($id)
    {
        $team = Team::find($id);
        $student = Student::find(Auth::user()->id);

        $student->team()->associate($team);
        $student->save();

        return redirect()->action('StudentsController@index', [$student->user->id]);
    }

    public function leave($id)
    {
        $team = Team::find($id);
        $student = Student::find(Auth::user()->id);

        $student->team()->dissociate();
        $student->save();

        return redirect()->action('StudentsController@index', [$student->user->id]);
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
        $student = Student::with('user')->find($id);
        return view('students.show', [
            'student' => $student,
            'roles' => $student->roles,
        ]);
    }

    public function getStudentsByRole() {
        $team = Student::find(Auth::user()->id)->team;
        $roles = $team->roles->sortBy('name');
        $students = new Collection();
        foreach ($roles as $role) {
            $tmpstudents = $role->students->sortBy('name');
            foreach ($tmpstudents as $student) {
                if($student->team != $team) {
                    $students->push($student);
                }
            }
        }
        //RETURN SOME VIEW
        return $students;
    }
}
