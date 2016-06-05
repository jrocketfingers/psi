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

//Route for deleting accounts
Route::post('/users/destroy/{id}', 'UsersController@destroy');

// Route::resource('students', 'StudentsController');
Route::get('/students', 'StudentsController@index');
Route::get('/students/edit/{id}', 'StudentsController@edit');
Route::post('/students/edit', 'StudentsController@update');
Route::get('/students/team/show', 'StudentsController@showTeam');
Route::get('/students/team/create', 'StudentsController@showTeamCreationForm');
Route::post('/students/team/create', 'StudentsController@createTeam');
Route::get('/students/team/delete', 'StudentsController@disbandTeam');
Route::get('/students/team/join/{id}', 'StudentsController@join');
Route::get('/students/team/leave/{id}', 'StudentsController@leave');
Route::get('/students/list', 'StudentsController@getStudentsByRole');
Route::get('/students/show/{id}', 'StudentsController@show');
Route::get('/students/notifications', 'StudentsController@getNotifications');
Route::get('/students/team/edit/{id}', 'StudentsController@editTeam');
Route::post('students/team/store', 'StudentsController@storeTeam');
Route::get('/students/team/search', 'StudentsController@searchTeams');

/*Route::get('/students', 'StudentsController@getAll');
Route::get('/students/{role_id}', 'StudentsController@getByRole');*/
//Assistants logic
Route::get('/assistants/show', 'AssistantsController@showDetails');
Route::get('/assistants/edit', 'AssistantsController@editDetails');
Route::post('/assistants/update', 'AssistantsController@updateDetails');
Route::get('/assistants/getAllStudents', 'AssistantsController@getAllStudents');
Route::get('/assistants/getAllTeams', 'AssistantsController@getAllTeams');
Route::get('/assistants/showStudentDetails/{id}', 'AssistantsController@showStudentDetails');
Route::get('/assistants/showTeamDetails/{id}', 'AssistantsController@showTeamDetails');
Route::get('/assistants/{id?}', 'AssistantsController@index');
Route::get('/assistants/role/{id}', 'AssistantsController@showRole');
//Admin logic
Route::get('/admins/users', 'AdminsController@showAllUsers');
Route::post('/admins/users/{id}', 'AdminsController@destroyUser');
Route::get('/admins/roles', 'AdminsController@getAllRoles');
Route::post('admins/roles', 'AdminsController@storeRole');
Route::get('/admins/roles/create', 'AdminsController@createRole');
Route::get('/admins/roles/show/{id}', 'AdminsController@showRole');
Route::get('/admins/roles/edit/{id}', 'AdminsController@editRole');
Route::post('/admins/roles/update/{id}', 'AdminsController@updateRole');
Route::post('/admins/roles/destroy/{id}', 'AdminsController@destroyRole');
Route::get('/admins/notifications', 'AdminsController@showAllNotifications');
Route::get('/admins/notifications/show/{id}', 'AdminsController@showNotificationDetails');
Route::get('/admins/requests', 'AdminsController@showAllRequests');
Route::get('/admins/requests/{id}', 'AdminsController@showRequestDetails');
Route::get('/admins/{id?}', 'AdminsController@index');
Route::get('/admins/users/search/', 'AdminsController@searchUsers');

//request routes
Route::get('/createjoin/{team_id}', "JoinsController@create");
Route::get('/createinvite/{student_id}', 'InvitesController@create');
Route::get('/createkick/{student_id}', 'KicksController@create');
Route::get('/createleaderchange/{student_id}', 'LeaderChangesController@create');
Route::get('/action/{id}/{accepted}', 'RequestsController@action');
