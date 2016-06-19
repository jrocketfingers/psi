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
        $user = factory(App\User::class)->create([ 'password' => bcrypt('admin') ]);
        $admin = factory(App\Admin::class)->create([ 'user_id' => $user->id ]);
        $admin = Admin::find($user->id);

        $role = factory(App\Role::class)->create();
        $this->actingAs($admin->user)
             ->seeInDatabase('roles', [ 'id' => $role->id ])
             ->call('POST', '/admins/roles/destroy/'.$role->id);

        $role = Role::find($role->id);

        $this->assertTrue($role == null);

    }

    public function testRoleDetailsShow()
    {
        $user = factory(App\User::class)->create();
        $admin = factory(App\Admin::class)->create(['user_id' => $user->id]);
        $admin = Admin::find($user->id);

        $role = factory(App\Role::class)->create();

        $this->actingAs($admin->user);

        $response = $this->call('GET', '/admins/roles/show/'.$role->id)->original;
        $this->assertViewHas('role');
        $test = $response['role'];

        $this->assertEquals($role->id, $test->id);

        $role->delete();

        $admin->user->delete();


    }

    public function testRoleDetailsEdit()
    {
        $user = factory(App\User::class)->create();
        $admin = factory(App\Admin::class)->create(['user_id' => $user->id]);
        $admin = Admin::find($user->id);

        $role = factory(App\Role::class)->create();

        $mock = factory(App\Role::class)->make();

        $this->actingAs($admin->user)
             ->visit('/admins/roles/show/'.$role->id)
             ->click('Edit')
             ->type($mock->name, 'name')
             ->type($mock->description,'description')
             ->press('Submit changes')
             ->seeInDatabase('roles', [ 'name' => $mock->name, 'description' => $mock->description, 'id' => $role->id ]);

        $role = Role::where('name', 'like', $mock->name)
                    ->where('description', 'like', $mock->description)
                    ->where('id', 'like', $role->id)
                    ->firstOrFail();

        $this->assertTrue($role != null);

        $role->delete();

    }

    public function testNotificationDetailsShow()
    {
        $user = factory(App\User::class)->create();
        $admin = factory(App\Admin::class)->create(['user_id' => $user->id]);
        $admin = Admin::find($user->id);

        $user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $request = factory(App\Request::class)->create([ 'student_id' => $student->user->id ]);

        $notification = factory(App\Notification::class)->create([
                            'student_id' => $student->user->id,
                            'request_id' => $request->id,
                        ]);

        $this->actingAs($admin->user);
        
        $response = $this->call('GET', '/admins/notifications/show/'.$notification->id)->original;
        $this->assertViewHas('notification');
        $test = $response['notification'];

        $this->assertEquals($notification->id, $test->id);

        $notification->delete();

        $admin->user->delete();
        $student->user->delete();

    }

    public function testRequestDetailsShow()
    {
        $user = factory(App\User::class)->create();
        $admin = factory(App\Admin::class)->create(['user_id' => $user->id]);
        $admin = Admin::find($user->id);

        $user = factory(App\User::class)->create();
        $student = factory(App\Student::class)->create(['user_id' => $user->id]);
        $student = Student::find($user->id);

        $request = factory(App\Request::class)->create([ 'student_id' => $student->user->id ]);

        $this->actingAs($admin->user);
        
        $response = $this->call('GET', '/admins/requests/'.$request->id)->original;
        $this->assertViewHas('request');
        $test = $response['request'];

        $this->assertEquals($request->id, $test->id);

        $request->delete();

        $admin->user->delete();
        $student->user->delete();


    }

}
