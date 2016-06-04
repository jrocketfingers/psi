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
        factory(App\Team::class, 15)->create()->each(function($u) {
            $students = factory(App\Student::class, 3)->make();
            $students[0]->is_leader = 1;
            $u->students()->saveMany($students);
        });
    }
}
