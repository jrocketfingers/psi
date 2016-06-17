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
                        if($kick->request->status == "PENDING") {
                            $kick->request->delete();
                        }
                    }
                    foreach ($student->leaderChanges as $leaderchange) {
                        if($leaderchange->request->status == "PENDING") {
                            $leaderchange->request->delete();
                        }
                    }
                } else {
                    foreach ($student->team->students as $team_student) {
                        foreach ($team_student->kicks as $kick) {
                            if($kick->request->status == "PENDING") {
                                $kick->request->delete();
                            }
                        }
                        foreach ($team_student->leaderChanges as $leaderhange) {
                            if($leaderhange->request->status == "PENDING") {
                                $leaderhange->request->delete();
                            }
                        }
                    }
                    foreach ($student->team->joins as $join) {
                        if($join->request->status == "PENDING") {
                            $join->delete();
                        }
                    }
                    foreach ($student->requests as $request) {
                        if($request->status == "PENDING") {
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
        $user = User::find($id);
        if($user->image) {
            $image = $user->image;
            $user->image_id = null;
            $user->save();
            $image->delete();
        }
        $user->delete();

        return redirect()->action('HomeController@index');
    }
}
