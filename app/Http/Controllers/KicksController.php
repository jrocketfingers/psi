<?php

namespace App\Http\Controllers;

use App\Kick;
use App\Notification;
use App\Student;
use App\Vote;
use App\Request;
use Illuminate\Support\Facades\Auth;

class KicksController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        //$this->middleware('is_leader_kick'); //OVO TREBA DA BUDE UBACENO KADA ODRADIMO OVO PREKO NEKE FORME
    }

    public function create($student_id) {

        $request = Request::createRequest();
        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Kick";
        $request->save();

        $kick = new Kick();
        $kick->request_id = $request->id;
        $kick->num_voted = 0;
        $kick->student_id = $student_id;
        $kick->save();
        $team = Student::find(Auth::user()->id)->team;

        foreach($team->students as $student) {
            $can_show = false;
            if($student->user_id != $student_id) {
                Vote::create([
                    'request_id' => $request->id,
                    'student_id' => $student->user_id,
                ]);
                $can_show = true;
            }

            Notification::createNotification($request, $student, "NEW KICK REQUEST", $can_show, false);
        }

        return back()->withInput();
    }
}
