<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Requests\Request;
use App\Requests\Requestable;
use App\Requests\ReasonlessReject;

class JoinRequest extends Model implements Requestable
{
    use ReasonlessReject;

    protected $table = "join_requests";
    protected $fillable = ['team', 'role'];

    public function request() {
        return $this->morphOne('Request', 'requestable');
    }

    /**
     * Accept the join request.
     *
     * @param User confirmer - the user who has rejected the join request
     */
    public function accept(User $accepter) {
        $this->team->addMember($this->requestable()->requester(),
                                 $this->role);

        $this->requestable()->accept($accepter);
    }
}

