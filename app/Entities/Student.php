<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;

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
}
