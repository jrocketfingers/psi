<?php

namespace App\Http\Controllers;

use App\Request;

use App\Http\Requests;

class RequestsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function action($id, $accepted) {
        if($accepted === true) {
            Request::find($id)->requastable()->accept();
        } else {
            Request::find($id)->requastable()->deny();
        }
        //redirect
    }

    public function destroyRequest($id) {
        Request::destroy($id);
        //redirect
    }
}
