<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Student;
use App\Role;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

    	for ($i = 5; $i < 50; $i++)
    	{
    		$name = "test_user_".$i;
    		$password = bcrypt("test_user_".$i);
    		$email = "test_user".$i."@email.com";
    		
	        $user = User::create([
	        	'name' => $name,
	        	'email' => $email,
	        	'password' => $password,
	        ]);

	        $student = Student::create([
	        	'user_id' => $user->id,
	        ]);

            $student = Student::find($user->id);


	        $student->roles()->sync(Role::all());
	        $student->save();
    	}

    }
}
