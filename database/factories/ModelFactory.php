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

$factory->define(App\Request::class, function (Faker\Generator $faker) {
    return [
        'status' =>  $faker->word ,
        'student_id' => factory(App\Student::class)->create()->user_id,
        'requestable_id' =>  $faker->randomNumber() ,
        'requestable_type' =>  $faker->word ,
    ];
});

$factory->define(App\Join::class, function (Faker\Generator $faker) {
    return [
        'team_id' => factory(App\Team::class)->create()->id,
    ];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
    ];
});

$factory->define(App\Notification::class, function (Faker\Generator $faker) {
    return [
        'text' =>  $faker->sentence,
        'can_show' =>  $faker->boolean,
        'student_id' => factory(App\Student::class)->create()->user_id,
        'request_id' => factory(App\Request::class)->create()->id,
    ];
});

$factory->define(App\Kick::class, function (Faker\Generator $faker) {
    return [
        'num_voted' => $faker->numberBetween(0, 4),
        'student_id' => factory(App\Student::class)->create()->user_id,
    ];
});

$factory->define(App\Assistant::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id
    ];
});

$factory->define(App\Vote::class, function (Faker\Generator $faker) {
    return [
        'request_id' => factory(App\Request::class)->create()->id,
        'student_id' => factory(App\Student::class)->create()->user_id
    ];
});

$factory->define(App\Team::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->company ,
        'project_name' =>  $faker->catchPhrase ,
        'description' =>  $faker->paragraph(3, true) ,
        'creation_date' =>  $faker->dateTimeBetween() ,
    ];
});

$factory->define(App\LeaderChange::class, function (Faker\Generator $faker) {
    return [
        'num_voted' =>  $faker->numberBetween(0, 4) ,
        'student_id' => factory(App\Student::class)->create()->user_id,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->name ,
        'email' =>  $faker->safeEmail ,
        'password' =>  bcrypt($faker->password) ,
        'remember_token' =>  str_random(10) ,
    ];
});

$factory->define(App\Student::class, function (Faker\Generator $faker) {
    return [
        'team_id' => 0,
        'is_leader' =>  0,
        'user_id' => factory(App\User::class)->create()->id,
    ];
});

$factory->defineAs(App\Student::class, 'empty', function (Faker\Generator $faker) {
    return [
        'team_id' => 0,
        'is_leader' =>  0,
        'user_id' => factory(App\User::class)->create()->id,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' =>  $faker->name ,
        'description' =>  $faker->word ,
    ];
});

$factory->define(App\Invite::class, function (Faker\Generator $faker) {
    return [
        'student_id' => factory(App\Student::class)->create()->user_id,
    ];
});
