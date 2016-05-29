<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function showAllUsers() {
        $users = User::all();

        return view('admins.showAllUsers')->with('users', $users);
    }

    public function destroyUser($id) {
        User::destroy($id);

        return redirect()->action('AdminsCotnroller@showAllUsers');
    }
}
