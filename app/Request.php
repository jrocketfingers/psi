<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public function object() {
        return $this->morphTo();
    }

    public function accept() {
        $this->status = 'accepted';
        $this->save();
    }

    public function reject() {
        $this->status = 'rejected';
        $this->save();
    }
}
