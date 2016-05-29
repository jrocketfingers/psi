<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;

/*
 * @ORM\Entity
 * @ORM\table(name="admins")
 */
class Admin extends User
{
}
