<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_UNRESOLVED = 'unresolved';

    public function requester() {
        return $this->hasOne('App\User');
    }

    public function requestable() {
        return $this->morphTo();
    }
}
