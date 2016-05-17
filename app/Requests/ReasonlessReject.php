<?php

use App\User;


trait ReasonlessReject {
    /**
     * Reject the join request.
     *
     * @param User rejecter - the user who has rejected the join request
     */
    public function reject(User $rejecter) {
        $this->requestable()->reject($rejecter);
    }
}

