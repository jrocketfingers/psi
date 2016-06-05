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

    public function create(\Illuminate\Http\Request $req, $student_id) {

        if(Kick::with('request')->where('student_id', '=', $student_id)->whereHas('request', function($q) {
            return $q->where('status', 'PENDING');
        })->first() != null) {
            $req->session()->flash('message', 'Kick request alrady exists.');
            $req->session()->flash('alert-class', 'alert-danger');

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
        $team = Student::find(Auth::user()->id)->team;

        $kick_student = Student::find($student_id);

        if($kick_student->is_leader) {
            $req->session()->flash('message', 'You cannot vote to kick the team leader!');
            $req->session()->flash('alert-class', 'alert-danger');

            return back()->withInput();
        }

        $message = "New kick request for " . $kick_student->user->name;
        $req->session()->flash('message', $message);
        $req->session()->flash('alert-class', 'alert-success');

        foreach($team->students as $student) {
            $can_show = false;
            if($student->user_id != $student_id) {
                Vote::create([
                    'request_id' => $request->id,
                    'student_id' => $student->user_id,
                ]);
                $can_show = true;

                Notification::createNotification($request, $student, $message, $can_show, false);
            }
        }

        return back()->withInput();
    }
}
