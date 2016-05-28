<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    const string accepted = "accepted";
    const string rejected = "rejected";
    const string unresolved = "unresolved";

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
