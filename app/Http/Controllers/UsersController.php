<?php

namespace App\Http\Controllers;

use App\Assistant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Admin;
use App\Student;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\RolesRepository;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
;        $users = User::where('name', '<>', 'admin')->get();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);

        if($validator->fails()) {
            return redirect('users/'.$request->input('id').'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->action('UsersController@show', [$request->input('id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', [
            'user' => $user,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student != null) {
            if($student->team != null) {
                if($student->is_leader == false) {
                    foreach ($student->kicks as $kick) {
                        if($kick->request->status != "CONFIRMED") {
                            $kick->request->delete();
                        }
                    }
                    foreach ($student->leaderChanges as $leaderchange) {
                        if($leaderchange->request->status != "CONFIRMED") {
                            $leaderchange->request->delete();
                        }
                    }
                } else {
                    foreach ($student->team->students as $team_student) {
                        foreach ($team_student->kicks as $kick) {
                            if($kick->request->status != "CONFIRMED") {
                                $kick->request->delete();
                            }
                        }
                        foreach ($team_student->leaderChanges as $leaderhange) {
                            if($leaderhange->request->status != "CONFIRMED") {
                                $leaderhange->request->delete();
                            }
                        }
                    }
                    foreach ($student->team->joins as $join) {
                        if($join->request->status != "CONFIRMED") {
                            $join->delete();
                        }
                    }
                    foreach ($student->requests as $request) {
                        if($request->status != "CONFIRMED") {
                            $request->delete();
                        }
                    }
                    $team = $student->team;
                    foreach ($team->students as $student) {
                        $student->team_id = null;
                        $student->is_leader = null;
                        $student->save();
                    }
                    $team->delete();
                }

            }
        }

        User::destroy($id);

        return redirect()->to('HomeController@index');
    }
}
