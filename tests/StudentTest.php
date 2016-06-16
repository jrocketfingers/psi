<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Student;
use App\Role;
use Faker\Factory as Faker;

class StudentTest extends TestCase
{

    public function testRegistration()
    {
    	$this->visit('/')
    		 ->click('Register')
    		 ->seePageIs('/register')
    		 ->type('Simke', 'name')
    		 ->type('simke@gmail.com', 'email')
    		 ->type('password', 'password')
    		 ->type('password', 'password_confirmation')
    		 ->type(csrf_token(), '_token')
    		 ->select('student', 'user_type')
    		 ->press('Submit')
    		 ->seeInDatabase('users', [ 'email' => 'simke@gmail.com' ]);

    	$student = Student::whereHas('user', function($query){ $query->where('email', 'like', 'simke@gmail.com');})->firstOrFail();
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
        	 ->seePageIs('/students?'.$student->user->id);
    }

    public function testDetailsDropDownSelect()
    {
    	$user = factory(App\User::class)->create([ 'password' => bcrypt('123123123') ]);
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $this->actingAs($user)
        	 ->visit('/students?'.$student->user->id)
        	 ->click($student->user->name)
        	 ->click('Details');

        print (string)$this->content;
        	 // ->assertViewHas(['student', 'show_student']);
    }

    public function testDetailsShow()
    {
        $user = factory(App\User::class)->create([ 'password' => bcrypt('123123123') ]);
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $response = $this->actingAs($user)
                         ->call('GET', '/students/show/', [ 'id' => $student->user->id ]);

        print (string)$response;
    }

}
