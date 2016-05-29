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
    	/*factory(App\Team::class, 20)->create()->each(function($team){
            
    		$students = factory(Student::class, 5)->create()->each(function($user){

    			$user->roles()->save($faker->randomElements(Role::all()->toArray(), 5));

    		});

			$team->students()->save($students);
    	});*/


        /*$table->string('name');
            $table->string('project_name');
            $table->string('description');*/

        DB::table('teams')->insert([
            [
                'name' => 'Team 1',
                'project_name' => 'Project 1',
                'description' => 'Description 1',
            ], [
                'name' => 'Team 2',
                'project_name' => 'Project 2',
                'description' => 'Description 2',
            ], [
                'name' => 'Team 3',
                'project_name' => 'Project 3',
                'description' => 'Description 3',
            ],
        ]);
    }
}
