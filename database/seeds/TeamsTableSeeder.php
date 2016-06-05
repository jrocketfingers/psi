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
        $faker = Faker::create();

        factory(App\Team::class, 15)->create()->each(function($u) {
            $students = factory(App\Student::class, 3)->make();
            $students[0]->is_leader = 1;

            foreach($students as $student) {
                $student->roles()->saveMany(Role::random($faker->numberBetween(2,5)));
            }

            $u->students()->saveMany($students);
        });
    }
}
