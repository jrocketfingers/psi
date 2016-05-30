<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Notification;
use App\Request;

use App\Http\Requests;

class InvitesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create($student_id) {
        $request = Request::createRequest();

        $request->requestable_id = $request->id;
        $request->requestable_type = "Invite";

        $invite = new Invite();
        $invite->request_id = $request->id;
        $invite->student_id = $student_id;
        $invite->save();

        Notification::createNotification($request->id, $student_id, "NEW INVITE REQUEST", true);

        //redirect to somewhere
    }
}
