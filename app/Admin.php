<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'id',
    ];

    public static function isAdmin($id) {
        if(Admin::find($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function user() {
        return $this->morphOne('App\User', 'userable');
    }
}
