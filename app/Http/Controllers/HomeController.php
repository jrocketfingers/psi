<?php

namespace App\Http\Controllers;

use App\Assistant;
use App\Http\Requests;
use App\Student;
use Illuminate\Http\Request;
use App\Admin;
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
        $id = Auth::user()->id;


        if (Student::isStudent($id)){
            return redirect()->action('StudentsController@index', [$id]);
        }

        if (Admin::isAdmin($id)){
            return redirect()->action('AdminsController@index', [$id]);
        }

        if (Assistant::isAssistant($id)){
            return redirect()->action('AssistantsController@index', [$id]);
        }

        return back()->withInput();
    }
}
