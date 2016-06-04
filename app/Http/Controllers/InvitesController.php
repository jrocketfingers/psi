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

    public function create($student_id) {
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

        Notification::createNotification($request, $student, "New invite request from team " . $team->name, true, false);

        return back()->withInput();
    }

    public function reply($notification_id)
    {
        $notification = Notification::find($notification_id);
        $request = $notification->request;
        if (Auth::user()->id == $notification->student->user->id && ($request->student->is_leader))
        {
            $student = $notification->student;

            $student->team()->associate($request->student->team);
            $student->save(); 
        }

        return $request;
    }
}
