<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class User extends Authenticatable
{
    use SingleTableInheritanceTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';

    protected static $singleTableTypeField = 'type';

    protected static $singleTableSubclasses = [
        Student::class, Assistant::class, Admin::class
    ];

    public function isStudent() {
        return $this->type == 'student';
    }

    public function isAssistant() {
        return $this->type == 'assistant';
    }

    public function isAdmin() {
        return $this->type == 'admin';
    }
}
