<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'request_id', 'student_id',
    ];

    public function request() {
        return $this->belongsTo('App\Request');
    }

    public function student() {
        return $this->belongsTo('App\Student');
    }

    public static function destroyVote($request_id,$student_id) {
        Vote::where('request_id', $request_id)
            ->where('student_id', $student_id)
            ->delete();
    }
}
