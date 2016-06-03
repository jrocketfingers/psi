<?php

namespace App\Http\Controllers;

use App\Join;
use App\Notification;
use App\Request;

use App\Http\Requests;
use App\Team;

class JoinsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create($team_id) {
        $request = Request::createRequest();

        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Join";
        $request->save();

        $join = new Join();
        $join->request_id = $request->id;
        $join->team_id = $team_id;
        $join->save();

        $notification = Notification::createNotification($request, Team::find($team_id)->students->where('is_leader', 1)->first(), "NEW JOIN REQUEST", true, false);

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
