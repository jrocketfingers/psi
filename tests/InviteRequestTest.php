<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Student;
use App\Invite;
use App\Request;
use App\Notification;


class InviteRequestTest extends TestCase
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

        $this->actingAs($leader->user);

        $request = Request::createRequest();

        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Invite";
        $request->save();

        $invite = new Invite();
        $invite->request_id = $request->id;
        $invite->student_id = $student->user->id;
        $invite->save();

        $this->assertTrue($request->status == "PENDING");

        $this->actingAs($student->user);

        $request->requestable->accept();
        $request = Request::find($request->id);

        $notification = Notification::where('request_id', 'like', $request->id);

        $this->assertTrue($notification != null);
        $this->assertTrue($request->status == "ACCEPTED");
    	$this->assertTrue($request->student != null);

    	$student = Student::find($student->user->id);

    	$this->assertEquals($leader->team->id, $student->team->id);


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

        $this->actingAs($leader->user);

        $request = Request::createRequest();

        $request->requestable_id = $request->id;
        $request->requestable_type = "App\\Invite";
        $request->save();

        $invite = new Invite();
        $invite->request_id = $request->id;
        $invite->student_id = $student->user->id;
        $invite->save();

        $this->assertTrue($request->status == "PENDING");

        $this->actingAs($student->user);

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
