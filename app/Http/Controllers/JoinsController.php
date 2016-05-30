<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Request;

use App\Http\Requests;
use Mockery\Matcher\Not;

class JoinsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create($team_id) {
        $request = Request::createRequest();

        $request->requeastble_id = $request->id;
        $request->requestable_type = "Join";
        $request->save();

        $join = new Join();
        $join->request_id = $request->id;
        $join->team_id = $team_id;
        $join->save();

        Notification::createNotification($request>id, Team::find($team_id)->students()->where('is_leader', '=', true)->first()->id, "NEW JOIN REQUEST", true);

        //redirect to somewhere
    }
}
