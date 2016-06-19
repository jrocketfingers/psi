<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Student;
use App\Assistant;
use App\Role;
use App\Team;
use App\Admin;
use Faker\Factory as Faker;

class AdminsTest extends TestCase
{
    public function testLogin()
    {
    	$user = factory(App\User::class)->create([ 'password' => bcrypt('admin') ]);
        $admin = factory(App\Admin::class)->create([ 'user_id' => $user->id ]);
        $admin = Admin::find($user->id);

    	$this->visit('/')
    		 ->click('Login')
    		 ->seePageIs('/login')
    		 ->type($admin->user->email, 'email')
    		 ->type('admin', 'password')
    		 ->type(csrf_token(), '_token')
    		 ->press('Submit')
    		 ->seePageIs('/admins/'.$admin->user->id);

        $admin->user->delete();
    }

    public function testUserDelete()
    {
        $user = factory(App\User::class)->create([ 'password' => bcrypt('admin') ]);
        $admin = factory(App\Admin::class)->create([ 'user_id' => $user->id ]);
        $admin = Admin::find($user->id);

        $user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create([ 'user_id' => $user->id ]);
        $student = Student::find($user->id);

        $this->actingAs($admin->user)
             ->call('POST', '/admins/users/'.$student->user->id);

        $student = Student::find($user->id);

        $this->assertTrue($student == null);


    }

    public function testRoleDelete()
    {

    }

    public function testRoleDetailsShow()
    {

    }

    public function testRoleDetailsEdit()
    {

    }

    public function testNotificationDetailsShow()
    {

    }

    public function testRequestDetailsShow()
    {

    }

}
