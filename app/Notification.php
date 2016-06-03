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

    public static function createNotification($request, $student, $text, $can_show, $info_only) {
        $notification = new Notification();
        $notification->request()->associate($request);
        $notification->student()->associate($student);
        $notification->text = $text;
        $notification->can_show = $can_show;
        $notification->info_only = $info_only;
        $notification->seen = false;
        $notification->save();

        return $notification;
    }
}
