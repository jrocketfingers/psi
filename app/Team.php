<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'project_name', 'description', 'creation_date',
    ];

    public function students() {
        return $this->hasMany('App\Student');
    }
    public function roles() {
        return $this->belongsToMany('App\Role');
    }
    public function joins() {
        return $this->hasMany('App\Join');
    }
}
