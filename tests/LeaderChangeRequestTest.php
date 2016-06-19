<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Team;
use App\Student;
use App\LeaderChange;
use App\Vote;
use App\Request;
use App\Notification;

class LeaderChangeRequestTest extends TestCase
{
    public function testAcceptRequest()
    {
    	$user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $team = factory(App\Team::class)->create();

        $user = factory(App\User::class)->create();
        $leader = factory(App\Student::class)->create([ 'user_id' => $user->id ]);
        $leader = Student::find($user->id);
        $leader->is_leader = true;
        $leader->team()->associate($team);
        $leader->save();

        $user = factory(App\User::class)->create();
        $another_student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $another_student = Student::find($user->id);
        $another_student->is_leader = false;
        $another_student->team()->associate($team);
        $another_student->save();

        $student->is_leader = false;
        $student->team()->associate($team);
        $student->save();

        $this->actingAs($student->user);

    	$request = Request::createRequest();
        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\LeaderChange";
        $request->save();

        $message = "New leader change request for " . $student->user->name;

        $leader_change = new LeaderChange();
        $leader_change->request_id = $request->id;
        $leader_change->num_voted = 0;
        $leader_change->student_id = $student->user->id;
        $leader_change->save();
        $team = Team::find($leader->team->id);

        $leader = Student::find($leader->user->id);

        foreach($team->students as $iter_student) {
            $can_show = false;
            if($iter_student->user->id != $student->user->id && $iter_student->is_leader == false) {
            	$this->assertEquals($iter_student->user->id, $another_student->user->id);

                Vote::create([
                    'request_id' => $request->id,
                    'student_id' => $iter_student->user->id,
                ]);
                $this->seeInDatabase('votes', [ 'request_id' => $request->id, 'student_id' => $iter_student->user->id ]);
                $can_show = true;
            }

            Notification::createNotification($request, $iter_student, $message, $can_show, false);
            $this->seeInDatabase('notifications', [ 'request_id' => $request->id, 'student_id' => $iter_student->user->id ]);
        }

        $another_student = Student::find($another_student->user->id);
        $this->actingAs($another_student->user);

        $request->requestable->accept();

        $leader = Student::find($leader->user->id);

        $student = Student::find($student->user->id);

        $this->assertTrue($leader->is_leader == false);
        $this->assertTrue($student->is_leader == true);

        $notification = Notification::where('student_id' , 'like', $student->user->id)
        							->where('request_id', 'like', $request->id);

       	$this->assertTrue($notification != null);

       	$notification->delete();
       	$request->delete();
        $student->user->delete();
        $leader->user->delete();
        $another_student->user->delete();
        $team->delete();


    }

    public function testDenyRequest()
    {

    }
}
