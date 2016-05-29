<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/*
 * @ORM\Entity
 * @ORM\Table(name = "teamrole")
 */
class TeamRole
{
    /*
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity = "Role", inversedBy = "teams")
     * @ORM\JoinColumn(name = "role_id", referencedColumnName = "id")
     */
    private $role;

    /*
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity = "Team", inversedBy = "roles")
     * @ORM\JoinColumn(name = "team_id", referencedColumnName = "id")
     */
    private $team;

    public function __construct($role, $team) {
        $this->role = $role;
        $this->team = $team;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }
}
