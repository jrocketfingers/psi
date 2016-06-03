<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'text', 'student_id', 'request_id', 'can_show', 'seen', 'info_only', 
    ];

    public function student() {
        return $this->belongsTo('App\Student');
    }
    public function request() {
        return $this->belongsTo('App\Request');
    }

    public static function createNotification($request_id, $student_id, $text, $can_show) {
        $notification = new Notification();
        $notification->request_id = $request_id;
        $notification->student_id = $student_id;
        $notification->text = $text;
        $notification->can_show = $can_show;
        $notification->seen = false;
        $notification->save();
    }
}
