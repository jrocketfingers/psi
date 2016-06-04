<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\Team;
use App\Role;
use App\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($id = null)
    {
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
        $student = Student::find(Auth::user()->id);
        $roles = array_column(Role::all()->toArray(), 'name', 'id');

        return view('students.team_creation',[
            'roles' => $roles,
            'student' => $student,
        ]);
    }

    public function showTeam()
    {
        $student = Student::find(Auth::user()->id);
        $team = $student->team;

        return view('students.team',[
            'student' => $student,
            'team' => $team,
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

    public function editTeam($id) {
        $team = Team::find($id);
        $student = Student::find(Auth::user()->id);

        return view('students.team_edit', [
            'student' => $student,
            'team' => $team,
        ]);
    }

    public function storeTeam(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'project_name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        
        if($validator->fails()) {
            return redirect()->action('StudentsController@editTeam', [$request->input('id')])
                            ->withErrors($validator)
                            ->withInput();
        }

        $team = Team::find($request->input('id'));
        $team->name = $request->input('name');
        $team->project_name = $request->input('project_name');
        $team->description = $request->input('description');
        $team->save();

        $student = Student::find(Auth::user()->id);

        return view('students.team',[
            'student' => $student,
            'team' => $team,
        ]);
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

    public function getNotifications()
    {
        /*if (Session::token() !== Input::get('_token'))
        {
            return Response::json(array(
                'message' => 'Unauthorized attempt to get notifications'
            ));
        }*/

        $student = Student::find(Auth::user()->id);
        $notifications = Student::find(Auth::user()->id)->notifications->where('seen', '=', false);
        
        foreach($notifications as $notification)
        {
            $notification->seen = true;
            $notification->save();
        }

        return array_values($notifications->all());
    }

    public function getAll() {
        $students = Student::getAll();
        $student = Student::find(Auth::user()->id);

        return view('students.index', [
            'students' => $students,
            'student' => $student,
        ]);
    }

    public function getByRole($role_id) {
        $students = Student::getByRole($role_id);
        $student = Student::find(Auth::user()->id);

        return view('students.index', [
           'students' => $students,
           'student' => $student,
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
        $show_student = Student::find($id);
        $student = Student::find(Auth::user()->id);

        return view('students.show', [
            'show_student' => $show_student,
            'roles' => $student->roles,
            'student' => $student,
        ]);
    }

    public function getStudentsByRole() {
        $student = Student::find(Auth::user()->id);
        $team = $student->team;
        $roles = $team->roles->sortBy('name');
        $students = new Collection();

        foreach ($roles as $role) {
            $tmpstudents = $role->students->sortBy('name');
            foreach ($tmpstudents as $student) {
                if($student->team == null) {
                    $students->push($student);
                }
            }
        }

        $student = Student::find(Auth::user()->id);

        return view('students.students', [
            'students' => $students,
            'student' => $student,
        ]);
    }
}
