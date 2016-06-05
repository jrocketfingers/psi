<?php

namespace App\Http\Controllers;

use App\Join;
use App\Notification;
use App\Request;

use App\Http\Requests;
use App\Student;
use App\Team;
use Illuminate\Support\Facades\Auth;

class JoinsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create(\Illuminate\Http\Request $req, $team_id) {

        $team = Team::findOrFail($team_id);

        $student = Student::find(Auth::user()->id);

        $join_requests = Join::whereHas('request', function($q) use ($student) {
            return $q->where('student_id', $student->user_id)->where('status', 'PENDING');
        })->where('team_id', $team_id)->first();

        if($join_requests) {
            $req->session()->flash('message', 'You have already applied to ' . $team->name);
            $req->session()->flash('alert-class', 'alert-danger');


            return back()->withInput();
        }

        $request = Request::createRequest();

        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Join";
        $request->save();

        $join = new Join();
        $join->request_id = $request->id;
        $join->team_id = $team_id;
        $join->save();

        $student = Student::find(Auth::user()->id);

        $req->session()->flash('message', 'You have successfully applied to ' . $team->name);
        $req->session()->flash('alert-class', 'alert-success');

        $leader_message = "Student " . $student->user->name . " wants to join your team";

        Notification::createNotification($request, $team->leader(), $leader_message, true, false);

        return back()->withInput();
    }

    public function reply($notification_id)
    {
        $notification = Notification::find($notification_id);
        $request = $notification->request;
        if ($notification->student->is_leader && (Auth::user()->id == $notification->student->user->id))
        {
            $student = Student::find(Auth::user()->id);

            $student->team()->associate($request->requestable->team);
            $student->save(); 
        }

        return $request->toJson();
    }
}
