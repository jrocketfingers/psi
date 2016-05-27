<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id',
    ];

    public function roles() {
    	return $this->hasMany('App\Role');
    }
}
