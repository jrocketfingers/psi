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
    }

    public function create($student_id) {
        $team = Student::find(Auth::user()->id)->team;
        //If num of memebers is two then just kick
        if($team->students->count() == 2) {
            $student = Student::find($student_id);
            Notification::createNotification(null, $student, "You have been kicked out of " . $team->name , true, true);
            $student->team_id = null;
            $student->is_leader = null;
            $student->save();

            return back()->withInput();
        }

        $request = Request::createRequest();
        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Kick";
        $request->save();

        $kick = new Kick();
        $kick->request_id = $request->id;
        $kick->num_voted = 0;
        $kick->student_id = $student_id;
        $kick->save();

        $kick_student = Student::find($student_id);

        foreach($team->students as $student) {
            $can_show = false;
            if($student->user_id != $student_id) {
                Vote::create([
                    'request_id' => $request->id,
                    'student_id' => $student->user_id,
                ]);
                $can_show = true;
            }

            Notification::createNotification($request, $student, "New kick request for " . $kick_student->name, $can_show, false);
        }

        return back()->withInput();
    }
}
