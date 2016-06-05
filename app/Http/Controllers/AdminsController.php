<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Request;
use App\Role;
use App\Student;
use App\User;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function index($id = null) {
        return view('admins.home');
    }

    public function showAllUsers() {
        $users = User::where('name', '!=', 'admin')->get();

        return view('admins.showAllUsers')->with('users', $users);
    }

    public function destroyUser($id) {
        $student = Student::find($id);
        if($student != null) {
            if($student->team != null) {
                if($student->is_leader == false) {
                    foreach ($student->kicks as $kick) {
                        if($kick->request->status != "CONFIRMED") {
                            $kick->request->delete();
                        }
                    }
                    foreach ($student->leaderChanges as $leaderchange) {
                        if($leaderchange->request->status != "CONFIRMED") {
                            $leaderchange->request->delete();
                        }
                    }
                } else {
                    foreach ($student->team->students as $team_student) {
                        foreach ($team_student->kicks as $kick) {
                            if($kick->request->status != "CONFIRMED") {
                                $kick->request->delete();
                            }
                        }
                        foreach ($team_student->leaderChanges as $leaderhange) {
                            if($leaderhange->request->status != "CONFIRMED") {
                                $leaderhange->request->delete();
                            }
                        }
                    }
                    foreach ($student->team->joins as $join) {
                        if($join->request->status != "CONFIRMED") {
                            $join->delete();
                        }
                    }
                    foreach ($student->requests as $request) {
                        if($request->status != "CONFIRMED") {
                            $request->delete();
                        }
                    }
                    $team = $student->team;
                    foreach ($team->students as $student) {
                        $student->team_id = null;
                        $student->is_leader = null;
                        $student->save();
                    }
                    $team->delete();
                }

            }
        }

        $user = User::find($id);
        if($user->image) {
            $image = $user->image;
            $user->image_id = null;
            $user->save();
            $image->delete();
        }
        $user->delete();
        $users = User::where('name', '!=', 'admin')->get();

        return view('admins.showAllUsers')->with('users', $users);
    }

    public function getAllRoles()
    {
        $roles = Role::all();

        return view('admins.showAllRoles', [
            'roles' => $roles
        ]);
    }

    public function createRole()
    {
        return view('admins.createRole');
    }

    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255|unique:roles',
            'description' => 'required|max:500',
        ]);

        if($validator->fails()) {
            return redirect()->action('AdminsController@createRole')
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return view('admins.showRole', [
            'role' => $role,
        ]);
    }

    public function showRole($id)
    {
        $role = Role::find($id);
        return view('admins.showRole', [
            'role' => $role
        ]);
    }

    public function editRole($id)
    {
        $role = Role::find($id);
        return view('admins.editRole', [
            'role' => $role,
        ]);
    }

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
        ]);

        if($validator->fails()) {
            return redirect()->action('AdminsController@editRole', [$id])
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->description = $request->input('description');
        $role->save();

        return redirect()->action('AdminsController@getAllRoles');
    }

    public function destroyRole($id)
    {
        Role::destroy($id);
        return redirect()->action('AdminsController@getAllRoles');
    }

    public function showAllNotifications() {
        $notifications = Notification::all();

        return view('admins.showNotifications', [
            'notifications' => $notifications,
        ]);
    }

    public function showNotificationDetails($id) {
        $notification = Notification::find($id);

        return view('admins.showNotificationDetails', [
            'notification' => $notification,
        ]);
    }

    public function showAllRequests() {
        $requests = Request::all();

        return view('admins.showRequests', [
            'requests' => $requests,
        ]);
    }
    
    public function showRequestDetails($id) {
        $request = Request::find($id);

        return view('admins.showRequestDetails', [
            'request' => $request,
        ]);
    }
}
