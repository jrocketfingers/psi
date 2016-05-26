<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id',
    ];

    public static function isStudent($id) {
        $student = Student::find($id);
        if($student) {
            return true;
        } else {
            return false;
        }
    }
}
