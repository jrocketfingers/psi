<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Student;
use App\Join;
use App\Request;
use App\Notification;

class JoinRequestTest extends TestCase
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

        $this->actingAs($student->user);

        $request = Request::createRequest();
        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Join";
        $request->save();

        $join = new Join();
        $join->request_id = $request->id;
        $join->team_id = $team->id;
        $join->save();

        $this->assertTrue($request->status == "PENDING");

        $this->actingAs($leader->user);

        $request->requestable->accept();
        $request = Request::find($request->id);

        $notification = Notification::where('request_id', 'like', $request->id);

        $this->assertTrue($notification != null);
        $this->assertTrue($request->status == "ACCEPTED");
    	$this->assertTrue($request->student != null);


    	$notification->delete();
    	$request->delete();
    	$student->user->delete();
    	$leader->user->delete();
    	$team->delete();
    }

    public function testDenyRequest()
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

        $this->actingAs($student->user);

        $request = Request::createRequest();
        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Join";
        $request->save();

        $join = new Join();
        $join->request_id = $request->id;
        $join->team_id = $team->id;
        $join->save();

        $this->assertTrue($request->status == "PENDING");

        $this->actingAs($leader->user);

        $request->requestable->deny();
        $request = Request::find($request->id);

        $notification = Notification::where('request_id', 'like', $request->id);

        $this->assertTrue($notification != null);
        $this->assertTrue($request->status == "DENIED");
    	$this->assertTrue($request->student != null);


    	$notification->delete();
    	$request->delete();
    	$student->user->delete();
    	$leader->user->delete();
    	$team->delete();

    }
}
