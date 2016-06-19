<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Student;
use App\Assistant;
use App\Role;
use App\Team;
use Faker\Factory as Faker;

class AssistantsTest extends TestCase
{
    public function testRegistration()
    {
        $mock = factory(App\User::class)->make();

        $this->visit('/')
             ->click('Register')
             ->seePageIs('/register')
             ->type($mock->name, 'name')
             ->type($mock->email, 'email')
             ->type($mock->password, 'password')
             ->type($mock->password, 'password_confirmation')
             ->type(csrf_token(), '_token')
             ->select('assistent', 'user_type')
             ->press('Submit')
             ->seeInDatabase('users', [ 'email' => $mock->email ]);

        $assistant = Assistant::whereHas('user', function($query) use ($mock) { 
                        $query->where('email', 'like', $mock->email);
                    })->firstOrFail();

        $assistant->user->delete();
    }


    public function testStudentDetailsShow()
    {
        $user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $user = factory(App\User::class)->create();
        $assistant = factory(App\Assistant::class)->create([ 'user_id' => $user->id ]);
        $assistant = Assistant::find($user->id);

        $this->actingAs($assistant->user);

        $response = $this->call('GET', '/assistants/showStudentDetails/'.$student->user->id)->original;
        $this->assertViewHas('student');
        $test = $response['student'];

        $this->assertEquals($student->user->id, $test->user->id);    

        $student->user->delete();
        $assistant->user->delete();

    }

    public function testTeamDetailsShow()
    {
        $team = factory(App\Team::class)->create();

        $user = factory(App\User::class)->create();
        $assistant = factory(App\Assistant::class)->create([ 'user_id' => $user->id ]);
        $assistant = Assistant::find($user->id);

        $this->actingAs($assistant->user);

        $response = $this->call('GET', '/assistants/showTeamDetails/'.$team->id)->original;
        $this->assertViewHas('team');
        $test = $response['team'];

        $this->assertEquals($team->id, $test->id);    

        $team->delete();
        $assistant->user->delete();

    }


}
