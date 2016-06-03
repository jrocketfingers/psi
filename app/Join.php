<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Join extends Model
{
    protected $primaryKey = 'request_id';
    protected $fillable = [
        'request_id', 'team_id',
    ];

    public function request() {
        return $this->morphOne('App\Request', 'requestable');
    }
    public function team() {
        return $this->belongsTo('App\Team');
    }

    public function accept() {
        $student = $this->request->student;
        $student->team()->associate(Student::find(Auth::user()->id)->team);
        $student->is_leader = false;
        $student->save();

        $this->request->status = "ACCEPTED";
        $this->request->save();
        Notification::createNotification($this->request, $student , "JOIN ACCEPTED" , true, true);
    }

    public function deny() {
        $this->request->status = "DENIED";
        $this->request->save();
        Notification::createNotification($this->request, $this->request->student , "JOIN DENIED" , true, true);
    }

}
