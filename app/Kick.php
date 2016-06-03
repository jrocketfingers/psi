<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kick extends Model
{
    protected $primaryKey = 'request_id';
    protected $fillable = [
        'request_id', 'student_id', 'num_voted'
    ];

    public function request() {
        return $this->morphOne('App\Request', 'requestable');
    }
    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function accept() {
        $student_id = Auth::user()->id;
        Vote::destroyVote($this->request_id, $student_id);
        $this->num_voted++;
        $this->save();
        //AKO JE POSLEDNJI GLASAO ZA MINUS JEDAN KOJI SE IZBACUJE
        if($this->num_voted == count($this->student->team->students) - 1) {
            //NAPRAVIMO PRVO NOTIFIKACIJE ZA SVE
            foreach ($this->student->team->students as $student) {
                Notification::createNotification($this->request, $student, "KICK REQUEST ACCEPTED", true, true);
            }
            $this->request->status = "ACCEPTED";
            $this->request->save();
            //PA IZABACIMO IZ TIMA
            $this->student->team_id = null;
            $this->student->is_leader = null;
            $this->student->save();
        }

        //redirect to somewhere
    }

    public function deny() {
        foreach ($this->student->team->students as $student) {
            Notification::createNotification($this->request, $student, "KICK REQUEST DENIED", true, true);
            
            Vote::destroyVote($this->request_id, $student->user_id);
        }

        $this->request->status = "DENIED";
        $this->request->save();
        $this->num_voted = 0;
        $this->save();

        //redirect to somewhere
    }
}
