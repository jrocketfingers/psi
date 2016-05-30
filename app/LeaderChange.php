<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaderChange extends Model
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
        $this->numVoted++;
        $this->save();
        //AKO JE POSLEDNJI GLASAO ZA MINUS JEDAN KOJI SE ZA KOGA SE GLASA
        if($this->num_voted == count($this->student->team->students) - 1) {
            //NAPRAVIMO PRVO NOTIFIKACIJE ZA SVE
            foreach ($this->student->team->students as $student) {
                Notification::createNotification($this->request_id, $student->user_id, "LEADER CHANGE REQUEST ACCEPTED", true);
            }
            $this->request->status = "ACCEPTED";
            $this->request->save();
            //PA PROMENIMO VODJU
            foreach ($this->student->team->students as $student) {
                $student->is_leader = false;
                $student->save();
            }
            $this->student->is_leader = true;
            $this->student->save();
        }

        //redirect to somewhere
    }

    public function deny() {
        foreach ($this->student->team->students as $student) {
            Notification::createNotification($this->request_id, $student->user_id, "LEADER CHANGE REQUEST DENIED", true);
            Vote::destroyVote($this->request_id, $student->user_id);
        }

        $this->request->status = "DENIED";
        $this->request->save();
        $this->num_voted = 0;
        $this->save();

        //redirect to somewhere
    }
}
