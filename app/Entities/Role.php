<?php

namespace App\Entities;


use Doctrine\Common\Collections\ArrayCollection;

/*
 * @ORM\Entity
 * @ORM\Table(name = "roles")
 */
class Role
{
   /*
    * @ORM\ID
    * @ORM\GeneratedValue
    * @ORM\Column(type = "integer")
    */
    private $id;

    /*
     * @ORM\Column(length=40)
     */
    private $name;

    /*
     * @ORM\Column(length=250)
     */
    private $descripton;

    /*
     * @ORM\OneToMany(targetEntity = "StudentRole", mappedBy = "role")
     */
    private $students;

    /*
     * @ORM\OneToMany(targetEntity = "TeamRole", mappedBy = "role")
     */
    private $teams;

    public function __construct() {
        $this->students = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescripton()
    {
        return $this->descripton;
    }

    /**
     * @param mixed $descripton
     */
    public function setDescripton($descripton)
    {
        $this->descripton = $descripton;
    }

    /**
     * @return mixed
     */
    public function getStudentrole()
    {
        return $this->studentrole;
    }

    /**
     * @param mixed $studentrole
     */
    public function setStudentrole($studentrole)
    {
        $this->studentrole = $studentrole;
    }

    /**
     * @return mixed
     */
    public function getTeamrole()
    {
        return $this->teamrole;
    }

    /**
     * @param mixed $teamrole
     */
    public function setTeamrole($teamrole)
    {
        $this->teamrole = $teamrole;
    }




}
?>
