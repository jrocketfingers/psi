<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function students() {
        return $this->belongsToMany('App\Student');
    }
    public function teams() {
        return $this->belongsToMany('App\Team');
    }
}
