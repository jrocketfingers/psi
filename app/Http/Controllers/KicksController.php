<?php

namespace App\Http\Controllers;

use App\Kick;
use App\Notification;
use App\Student;
use App\Vote;
use App\Request;

class KicksController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('is_leader');
    }

    public function create($student_id) { //id studenta za izbacivanje
        $request = Request::createRequest();
        $request->requestable_id = $request->id;
        $request->requestable_type = "Kick";
        $request->save();

        $kick = new Kick();
        $kick->request_id = $request->id;
        $kick->num_voted = 0;
        $kick->student_id = $student_id;
        $kick->save();
        $team = Student::find(Auth::user()->id)->team;

        foreach($team->students as $student) {
            $can_show = false;
            if($student->id != $student_id) {
                Vote::create([
                    'request_id' => $request->id,
                    'student_id' => $student->user_id,
                ]);
                $can_show = true;
            }

            Notification::createNotification($request->id, $student->user_id, "NEW KICK REQUEST", $can_show);
        }
        //redirect to somewhere
    }
}
