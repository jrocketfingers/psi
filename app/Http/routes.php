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

Route::post('/users/destroy/{id}', 'UsersController@destroy')->middleware('is_leader');

//ROUTE FOR USERS PREVIEW AND DELETING ACCOUNTS FOR ADMINS
Route::get('/users', 'UsersController@index')->middleware('admin');

Route::resource('roles', 'RolesController');
//ROUTE FOR UPDATING ROLE INFO, CANT USE PUT VERB
Route::post('/roles/{id}', 'RolesController@update');
//ROUTE FOR DESTROYING ROLES, CANT USE DELETE VERB
Route::post('/roles/destroy/{id}', 'RolesController@destroy');


Route::resource('students', 'StudentsController');
Route::get('/students', 'StudentsController@index');
Route::get('/students/edit/{id}', 'StudentsController@edit');
Route::post('/students/edit', 'StudentsController@update');
Route::get('/students/team/create', 'StudentsController@showTeamCreationForm');
Route::post('/students/team/create', 'StudentsController@createTeam');
Route::get('/students/team/delete', 'StudentsController@disbandTeam');
Route::get('/students/team/join/{id}', 'StudentsController@join');
Route::get('/students/team/leave/{id}', 'StudentsController@leave');

/*Route::get('/students', 'StudentsController@getAll');
Route::get('/students/{role_id}', 'StudentsController@getByRole');*/
//Assistants logic
Route::get('/assistants/getAllStudents', 'AssistantsController@getAllStudents');
Route::get('/assistants/getAllTeams', 'AssistantsController@getAllTeams');
Route::get('/assistants/showStudentDetails/{id}', 'AssistantsController@showStudentDetails');
Route::get('/assistants/showTeamDetails/{id}', 'AssistantsController@showTeamDetails');
Route::get('/assistants/{id?}', 'AssistantsController@index');
//Admin logic
Route::get('/admins/showAllUsers', 'AdminsController@showAllUsers');
Route::post('/admins/destroyUser/{id}', 'AdminsController@destroy');
Route::get('/admins/{id?}', 'AdminsController@index');


//TEST ROUTES
Route::get('/avaliablestudents', 'StudentsController@getStudentsByRole');
Route::get('/createjoin/{team_id}', "JoinsController@create");
Route::get('/createinvite/{student_id}', 'InvitesController@create');
Route::get('/createkick/{student_id}', 'KicksController@create');
Route::get('/createleaderchange/{student_id}', 'LeaderChangesController@create');
Route::get('/action/{id}/{accepted}', 'RequestsController@action');