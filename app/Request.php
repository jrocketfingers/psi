<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Request extends Model
{
    protected $fillable = [
      'status', 'student_id', 'requestable_id', 'requestable_type'
    ];

    public function votesPending() {
        return $this->hasMany('App\Votes');
    }
    public function notifications() {
        return $this->hasMany('App\Notification');
    }
    public function student() {
        return $this->belongsTo('App\Student');
    }
    public function requestable() {
        return $this->morphTo()->first();
    }

    public static function createRequest() {
        $request = new Request();
        $request->status = "PENDING";
        $request->student_id = Auth::user()->id;
        $request->save();

        return $request;
    }

    public function accept() {

    }

    public function deny() {

    }
}
