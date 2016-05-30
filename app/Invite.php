<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $primaryKey = 'request_id';
    protected $fillable = [
        'request_id', 'student_id',
    ];

    public function request() {
        return $this->morphOne('App\Request', 'requestable');
    }
    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function accept() {
        $student = Student::find(Auth::user()->id);
        $student->team_id = $this->request->student->team_id;
        $student->is_leader = false;
        $student->save();

        $this->request->status = "ACCEPTED";
        $this->request->save();
        Notification::createNotification($this->request_id, $this->request->student_id , "INVITE ACCEPTED" , true);
    }

    public function deny() {
        $this->request->status = "DENIED";
        $this->request->save();
        Notification::createNotification($this->request_id, $this->request->student_id , "INVITE DENIED" , true);
    }
}
