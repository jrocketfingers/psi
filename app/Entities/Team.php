<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/*
 * @ORM\Entity
 * @ORM\Table(name="teams")
 */
class Team extends Model
{
    /*
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /*
     * @ORM\Column(length=40)
     */
    private $name;

    /*
     * @ORM\Column(length=40)
     */
    private $project_name;

    /*
     * @ORM\Column(length=250)
     */
    private $project_description;

    /*
     * @ORM\Column(type="datetime", name="date_create")
     */
    private $date_create;

    /*
     * @ORM\OneToMany(targetEntity="TeamRole", mappedBy="teams")
     */
    private $roles;

    public function __construct() {
        $this->roles = new ArrayColelction();
    }
}

