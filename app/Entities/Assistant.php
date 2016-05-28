<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nanigans\SingleTableInheritance\SingletableInheritanceTrait;

class Assistant extends Model
{
    /* define the inheritance type */
    protected static $singleTableType = 'assistant';

    protected $fillable = [
        'id',
    ];
}
