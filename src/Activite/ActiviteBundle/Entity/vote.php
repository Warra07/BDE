<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\voteRepository")
 */
class vote
{
    /**
     *
     * @ORM\Column(name="datechoisis", type="datetime")
     */
      private $datechoisis;
  /**
    * @ORM\ManyToOne(targetEntity="Activite\ActiviteBundle\Entity\en_vote", inversedBy="vote")
    * @ORM\JoinColumn(nullable=true)
    */
 private $envote;

 /**
    * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs", inversedBy="vote")
    * @ORM\JoinColumn(nullable=true)
    */
 private $user;
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
     * Set envote
     *
     * @param \Activite\ActiviteBundle\Entity\envote $envote
     *
     * @return vote
     */
    public function setEnvote(\Activite\ActiviteBundle\Entity\en_vote $envote = null)
    {
        $this->envote = $envote;

        return $this;
    }

    /**
     * Get envote
     *
     * @return \Activite\ActiviteBundle\Entity\envote
     */
    public function getEnvote()
    {
        return $this->envote;
    }

    /**
     * Set user
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user
     *
     * @return vote
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
     * Set datechoisis
     *
     * @param \DateTime $datechoisis
     *
     * @return valide
     */
    public function setDatechoisis($datechoisis)
    {
        $this->datechoisis = $datechoisis;

        return $this;
    }

    /**
     * Get datechoisis
     *
     * @return \DateTime
     */
    public function getDatechoisis()
    {
        return $this->datechoisis;
    }
}
