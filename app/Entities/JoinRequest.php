<?php

namespace App;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class JoinRequest extends Request
{
    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"all"}, fetch="EAGER")
     */
    protected $target;

    /**
     * @ORM\ManyToOne(targetEntity="Team", cascade={"all"}, fetch="EAGER")
     */
    protected $team;

    public function accept() {
        $target->team = $this->team;
    }
}
