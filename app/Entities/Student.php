<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/*
 * @ORM\Entity
 * @ORM\table(name="students")
 */
class Student extends User
{
    /*
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;

    /*
     * @ORM\OneToMany(targetEntity="StudentRole", mappedBy="student"
     */
    private $roles;

    public function __construct() {
        $this->roles = new ArrayCollection();
    }
}
