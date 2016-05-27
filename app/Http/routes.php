<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/tasks', 'HomeController@index');

Route::resource('users', 'UsersController');

Route::post('/users/destroy/{id}', 'UsersController@destroy');

//ROUTE FOR USERS PREVIEW AND DELETING ACCOUNTS FOR ADMINS
Route::get('/users', 'UsersController@index')->middleware('admin');

Route::resource('roles', 'RolesController');
//ROUTE FOR UPDATING ROLE INFO, CANT USE PUT VERB
Route::post('/roles/{id}', 'RolesController@update');
//ROUTE FOR DESTROYING ROLES, CANT USE DELETE VERB
Route::post('/roles/destroy/{id}', 'RolesController@destroy');

Route::get('/students_roles/create', 'StudentsRolesController@create');
Route::post('/students_roles/create', 'StudentsRolesController@store');
Route::post('students_roles/destroy/{role_id}', 'StudentsRolesController@destroy');
Route::get('/students_roles/{student_id}', 'StudentsRolesController@index');

Route::get('/students', 'StudentsController@getAll');
Route::get('/students/{role_id}', 'StudentsController@getByRole');
