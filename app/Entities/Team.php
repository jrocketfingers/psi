<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/*
 * @ORM\Entity
 * @ORM\Table(name="teams")
 */
class Team extends Model
{
    /*@ORM\Column(type="integer")
     */
    protected $id;

    /*@ORM\Column(length=40)
     */
    protected $name;

    /*@ORM\Column(length=40)
     */
    protected $project_name;

    /*@ORM\Column(length=250)
     */
    protected $project_description;

    /*@ORM\Column(type="datetime", name="create_date")
     */
    protected $date_create;

    /*
     * @ORM\OneToMany(targetEntity="TeamRole", mappedBy="teams")
     */
    private $roles;

    public function __construct() {
        $this->roles = new ArrayColelction();
    }
}

