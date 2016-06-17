<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Notification;
use App\Request;

use App\Http\Requests;
use App\Student;
use Illuminate\Support\Facades\Auth;

class InvitesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create(\Illuminate\Http\Request $req, $student_id) {

        if(Invite::where('student_id', '=', $student_id)->whereHas('request', function($q) {
            return $q->where('status', 'PENDING');
        })->first() != null) {
            $req->session()->flash('message', 'Invitation request alrady exists.');
            $req->session()->flash('alert-class', 'alert-danger');

            return back()->withInput();
        }

        $request = Request::createRequest();
        $student = Student::find($student_id);

        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Invite";
        $request->save();

        $invite = new Invite();
        $invite->request_id = $request->id;
        $invite->student_id = $student_id;
        $invite->save();

        $team = Student::find(Auth::user()->id)->team;

        $message = "New invite request from team " . $team->name;
        $req->session()->flash('message', $message);
        $req->session()->flash('alert-class', 'alert-success');

        Notification::createNotification($request, $student, $message, true, false);

        return back()->withInput();
    }
}
