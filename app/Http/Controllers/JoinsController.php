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

        Notification::createNotification($request->id, Team::find($team_id)->students->where('is_leader', 1)->first()->user_id, "NEW JOIN REQUEST", true);

        //Redirect to a view
        return $join;
    }
}
