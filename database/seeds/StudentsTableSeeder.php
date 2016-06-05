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
        factory(App\Student::class, 'empty', 15)->create()->each(function($student) {
            $faker = Faker::create();

            $student->user()->associate(factory(App\User::class)->make());

            $student->roles()->attach(Role::all()->random($faker->numberBetween(2,5)));
        });
    }
}
