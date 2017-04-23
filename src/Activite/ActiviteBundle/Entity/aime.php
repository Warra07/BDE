<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * aime
 *
 * @ORM\Table(name="aime")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\aimeRepository")
 */
class aime
{
    /**
    * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs", inversedBy="aime")
    */
    private $user;
    /**
    * @ORM\ManyToOne(targetEntity="Activite\ActiviteBundle\Entity\album", inversedBy="aime")
    */
 private $album;

 

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user
     *
     * @return aime
     */
    public function setUser(\Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set album
     *
     * @param \Activite\ActiviteBundle\Entity\album $album
     *
     * @return aime
     */
    public function setAlbum(\Activite\ActiviteBundle\Entity\album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \Activite\ActiviteBundle\Entity\album
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
