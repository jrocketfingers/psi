<?php

namespace App\Http\Controllers;

use App\LeaderChange;
use App\Notification;
use App\Request;
use App\Student;
use App\Vote;
use Illuminate\Support\Facades\Auth;

class LeaderChangesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create($student_id) {
        


        $request = Request::createRequest();
        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\LeaderChange";
        $request->save();

        $leader_change = new LeaderChange();
        $leader_change->request_id = $request->id;
        $leader_change->num_voted = 0;
        $leader_change->student_id = $student_id;
        $leader_change->save();
        $team = Student::find(Auth::user()->id)->team;

        $leader_student = Student::find($student_id);

        foreach($team->students as $student) {
            $can_show = false;
            if($student->user_id != $student_id && $student->is_leader == false) {
                Vote::create([
                    'request_id' => $request->id,
                    'student_id' => $student->user_id,
                ]);
                $can_show = true;
            }

            Notification::createNotification($request, $student, "New leader change request for " . $leader_student->name, $can_show, false);
        }
     
        return back()->withInput();

    }
}
