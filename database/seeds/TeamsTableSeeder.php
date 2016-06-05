<?php

use Illuminate\Database\Seeder;
use App\Team;
use App\Student;
use App\Role;
use Faker\Factory as Faker;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Team::class, 15)->create()->each(function($team) {
            $students = factory(App\Student::class, 3)->make();
            $students[0]->is_leader = 1;

            $team->students()->saveMany($students);

            $faker = Faker::create();

            foreach($team->students as $student) {
                $student->roles()->attach(Role::all()->random($faker->numberBetween(2,5)));
            }
        });
    }
}
