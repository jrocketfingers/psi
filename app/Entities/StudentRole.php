<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/*
 * @ORM\Entity
 * @ORM\Table(name = "studentsroles")
 */
class StudentRole
{
    /*
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity = "Role", inversedBy = "students")
     * @ORM\JoinColumn(name = "role_id", referencedColumnName = "id")
     */
    private $role;

    /*
     * @ORM\id
     * @ORM\ManyToOne(targetEntity = "Student", inversedBy = "roles")
     * @ORM\JoinColumn(name = "student_id", referencedColumnName = "id")
     */
    private $student;

    public function __construct($role, $student) {
        $this->role = $role;
        $this->student = $student;
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
