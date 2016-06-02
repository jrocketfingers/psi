<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        User::destroy($id);

        return redirect()->action('AdminsCotnroller@showAllUsers');
    }
}
