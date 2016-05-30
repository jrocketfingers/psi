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

    public static function destroyVote($requset_id,$student_id) {
        Vote::whrere('request_id', '=', $requset_id)
            ->where('student_id', '=', $student_id)
            ->destroy();
    }
}
