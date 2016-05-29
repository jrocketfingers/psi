<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class Request
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"all"}, fetch="EAGER")
     */
    protected $requester;

    /**
     * @ORM\Column(type="string")
     */
    protected $status;

    public function accept() {
        $this->status = 'accepted';
    }

    public function reject() {
        $this->status = 'rejected';
    }
}

