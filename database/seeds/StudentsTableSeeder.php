<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\User;
use App\Student;
use App\Role;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 15) as $index) {
            $user = factory(App\User::class)->create();
            $student = factory(App\Student::class)->create(['user_id' => $user->id]);

            $student = Student::find($user->id);

            $student->roles()->attach(Role::all()->random($faker->numberBetween(2,5)));
        }
    }
}
