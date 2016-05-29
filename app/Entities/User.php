<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\Authenticatable;
use Doctrine\ORM\Mapping as ORM;

/*
 * class User
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "assistant" = "Assistant", "admin"
 * = "Admin", "student" = "Student"})
 * @ORM\Table(name="users")
 */
class User implements Authenticatable {

   /*
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\column(type="integer", name="id")
    */
    private $id;

    //slippery var
   /*
    * @var string
    * @ORM\column(type="string", unique=true)
    */
    private $email;

    //slippery var
   /*
    * @var string
    * @ORM\column(type="string")
    */
    private $password;

    public function getEmail() {
        return $this->email;
    }

    public function getID() {
        return $this->id;
    }

    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
    }

    public function getAuthIdentifier()
    {
        // TODO: Implement getAuthIdentifier() method.
    }

    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }


}

