<?php

use Illuminate\Database\Seeder;
use App\Team;
use App\Student;
use App\Role;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Team::class, 20)->create()->each(function($team){
            
    		$students = factory(Student::class, 5)->create()->each(function($user){

    			$user->roles()->save($faker->randomElements(Role::all()->toArray(), 5));

    		});

			$team->students()->save($students);
    	});
    }
}
