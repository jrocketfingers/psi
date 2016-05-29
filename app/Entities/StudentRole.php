<?php

namespace App;

use Doctrine\ORM\Mapping AS ORM;

/*
 * @ORM\Entity
 * @ORM\Table(name = "studentrole")
 */
class StudentRole
{
    /*
     * @ORM\id
     * @ORM\ManyToOne(targetEntity = "Role", inversedBy = "students")
     * @ORM\JoinColumn(name = "role_id", referencedColumnName = "id")
     */
    private $role;

    /*
     * @ORM\id
     * @ORM\ManyToOne(targetEntity = "Student", inversedBy = "roles")
     * @ORM\JoinColumn(name = "role_id", referencedColumnName = "id")
     */
    private $student;

    public function __construct($role, $student, $degree) {
        $this->role = $role;
        $this->student = $student;
        $this->degree;
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
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param mixed $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }


}
