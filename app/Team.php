<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'project_name', 'description', 'creation_date',
    ];

    public function students() {
        return $this->hasMany('App\User');
    }
    public function roles() {
        return $this->hasMany('App\Roles');
    }
}
