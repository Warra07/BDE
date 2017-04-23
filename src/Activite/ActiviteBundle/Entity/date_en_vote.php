<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * dateenvote
 *
 * @ORM\Table(name="dateenvote")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\dateenvoteRepository")
 */
class dateenvote
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


}

