<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingletableInheritanceTrait;

class Student extends User
{
    /* define the inheritance type */
    protected static $singleTableType = 'student';

    protected $fillable = [
        'id',
    ];
}
