<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Doctrine\ORM\Mapping as ORM;

/*
 * class User
 * @ORM\Entity
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"user" = "User", "assistant" = "Assistant", "admin"
 * = "Admin", "student" = "Student"})
 * @table(name="users")
 */
class User implements Authenticatable {

   /*
    * @ORM/Id
    * @ORM/GeneratedValue
    * @ORM/column(type="integer", name="id")
    */
    protected $id;

   /*
    * @var string
    * @ORM/column(type="string", unique=true)
    */
    protected $email;

   /*
    * @var string
    * @ORM/column(type="string")
    */
    protected $password;

    public function getEmail() {
        return $this->email;
    }

    public function getID() {
        return $this->id;
    }

}

