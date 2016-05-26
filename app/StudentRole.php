<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRole extends Model
{
    protected $table = 'students_roles';

    protected $fillable = [
        'student_id', 'role_id'
    ];
}
