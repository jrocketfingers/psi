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

    }

    public function testTeamDetailsShow()
    {

    }

    public function testTeamDetailsStudentDetailsShow()
    {
    	
    }

}
