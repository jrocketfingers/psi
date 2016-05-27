<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use App\User;
use App\Role;
use App\Team;
use App\Student;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Student::class, function(Faker\Generator $faker){
	return [
		'id' => factory(User::class)->create()->id,
	];
});

$factory->define(App\Team::class, function(Faker\Generator $faker){
	$student = factory(Student::class)->create();
	$student->roles()->save($faker->randomElements(Role::all()->toArray(), 5));
	return [
		'name' => $faker->name,
		'project_name' => $faker->project_name,
		'description' => $faker->description,
		'leader_id' => $student->id,
	];
});