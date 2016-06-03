<?php

namespace App\Http\Controllers;

use App\Request;
use App\Notification;
use App\Http\Requests;

class RequestsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function action($id, $accepted) {
        $notification = Notification::find($id);
        $message = "Nothing";

        if ($notification->info_only == true)
        {
            $notification->text .= " SEEN";
        }
        else
        {
            if($accepted == true) {
                $notification->request->requestable()->accept();
                $message = "Accept Proceeded";
            } else {
                $notification->request->requestable()->deny();
                $message = "Deny Proceeded";
            }
        }
        
    
        $notification->save();

        return $message;
    }

    public function destroyRequest($id) {
        Request::destroy($id);
        
        return back()->withInput();
    }
}
