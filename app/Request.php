<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function requestable() {
        return $this->morphTo();
    }

    public static function createRequest() {
        $request = new Request();
        $request->status = "PENDING";
        $request->student_id = Auth::user()->id;
        $request->save();

        return $request;
    }
}
