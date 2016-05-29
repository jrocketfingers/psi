<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
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
    protected $team;

    /*
     * @ORM\OneToMany(targetEntity="StudentRole", mappedBy="students"
     */
    private $roles;

    public function __construct() {
        $this->roles = new ArrayCollection();
    }
}
