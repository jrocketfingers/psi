<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingletableInheritanceTrait;

class Admin extends User
{
    /* define the inheritance type */
    protected static $singleTableType = 'admin';

    protected $fillable = [
        'id',
    ];
}
