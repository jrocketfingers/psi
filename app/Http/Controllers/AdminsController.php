<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index($id = null) {
        return view('admins.home');
    }

    public function showAllUsers() {
        $users = User::where('name', '!=', 'admin')->get();

        return view('admins.showAllUsers')->with('users', $users);
    }

    public function destroyUser($id) {
        $student = Student::find($id);
        if($student != null) {
            if($student->team != null) {
                if($student->is_leader == false) {
                    foreach ($student->kicks as $kick) {
                        if($kick->requset->status != "CONFIRMED") {
                            $kick->request->delete();
                        }
                    }
                    foreach ($student->leaderChanges as $leaderhange) {
                        if($leaderhange->requset->status != "CONFIRMED") {
                            $leaderhange->request->delete();
                        }
                    }
                } else {
                    foreach ($student->team->students as $team_student) {
                        foreach ($team_student->kicks as $kick) {
                            if($kick->requset->status != "CONFIRMED") {
                                $kick->request->delete();
                            }
                        }
                        foreach ($team_student->leaderChanges as $leaderhange) {
                            if($leaderhange->requset->status != "CONFIRMED") {
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
        $users = User::where('name', '!=', 'admin')->get();

        return view('admins.showAllUsers')->with('users', $users);
    }
}
