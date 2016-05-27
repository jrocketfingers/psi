<?php

namespace App\Http\Controllers;

use App\Assistant;
use App\Http\Requests;
use App\Student;
use App\StudentRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = 'home';
        if(Assistant::isAssistant(Auth::user()->id)) {
            $path = 'assistants.'.$path;
        } else if(Student::isStudent(Auth::user()->id)) {
            $path = 'students.'.$path;
        } else {
            $path = 'admins.'.$path;
        }

        return view($path);
    }
}
