<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Student;
use App\Role;
use App\Team;
use Faker\Factory as Faker;

class StudentTest extends TestCase
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
      		 ->select('student', 'user_type')
      		 ->press('Submit')
      		 ->seeInDatabase('users', [ 'email' => $mock->email ]);

      	$student = Student::whereHas('user', function($query) use ($mock) { 
                          $query->where('email', 'like', $mock->email);
                      })->firstOrFail();

        $student->user->delete();
    }

    public function testLogin()
    {
      	$user = factory(App\User::class)->create([ 'password' => bcrypt('123123123') ]);
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $this->visit('/')
        	 ->click('Login')
        	 ->seePageIs('/login')
        	 ->type($student->user->email, 'email')
        	 ->type(123123123, 'password')
        	 ->type(csrf_token(), '_token')
        	 ->press('Submit')
        	 ->seePageIs('/students/index/'.$student->user->id);

        $student->user->delete();
    }

    public function testDetailsShow()
    {
      	$user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $this->actingAs($user)
        	 ->visit('/students/index/'.$student->user->id)
        	 ->click($student->user->name)
        	 ->click('Details')
        	 ->assertViewHas(['student', 'show_student']);

        $student->user->delete();
    }

    public function testDetailsEdit()
    {
        $user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $mock = factory(App\User::class)->make();

        $this->actingAs($student->user)
             ->visit('/students/show/'.$student->user->id)
             ->click('Edit')
             ->type($mock->name, 'name')
             ->type($mock->email,'email')
             ->press('Submit changes')
             ->seeInDatabase('users', [ 'name' => $mock->name, 'email' => $mock->email, 'id' => $user->id ]);

        $student = Student::whereHas('user', function($query) use ($user, $mock) { 
            $query->where('email', 'like', $mock->email)
                  ->where('name', 'like', $mock->name)
                  ->where('id', '=', $user->id);
        })->firstOrFail();

        $this->assertTrue($student != null);

        $student->user->delete();
    }

    public function testTeamCreation()
    {
        $user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $mock = factory(App\Team::class)->make();

        $this->actingAs($student->user)
             ->visit('/students/team/create')
             ->type($mock->name ,'name')
             ->type($mock->project_name, 'project_name')
             ->type($mock->description, 'description')
             ->type(csrf_token(), '_token')
             ->press('Submit')
             ->seePageIs('/students/index/'.$student->user->id)
             ->seeInDatabase('teams', [ 
                    'name' => $mock->name,
                    'project_name' => $mock->project_name,
                    'description' => $mock->description,
                ]);

        $student = Student::find($user->id);

        $this->assertTrue($student->is_leader == true);
        $this->assertEquals($student->team->name, $mock->name);
        $this->assertEquals($student->team->project_name, $mock->project_name);
        $this->assertEquals($student->team->description, $mock->description);

        $student->team->delete();
        $student->user->delete();
    }

    public function testTeamEdit()
    {
        $user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);
        $student->is_leader = true;
        $team = factory(App\Team::class)->create();
        $team->students()->save($student);

        $mock = factory(App\Team::class)->make();

        $this->actingAs($student->user)
             ->visit('/students/team/show/'.$student->team->id)
             ->click('Edit')
             ->type($mock->name ,'name')
             ->type($mock->project_name, 'project_name')
             ->type($mock->description, 'description')
             ->type(csrf_token(), '_token')
             ->press('Submit changes')
             ->seePageIs('/students/team/show/'.$student->team->id)
             ->seeInDatabase('teams', [
                    'id' => $team->id, 
                    'name' => $mock->name,
                    'project_name' => $mock->project_name,
                    'description' => $mock->description,
                ]);

        $this->assertEquals($team->id, $student->team->id);

        $team->delete();
        $student->user->delete();
    }

}
