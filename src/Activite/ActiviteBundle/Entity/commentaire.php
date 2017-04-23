<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\commentaireRepository")
 */
class commentaire
{
        /**
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs", inversedBy="commentaire")
     * @ORM\JoinColumn(nullable=true)
    */
private $user;

      /**
    * @ORM\ManyToOne(targetEntity="Activite\ActiviteBundle\Entity\activite", inversedBy="commentaire")
     * @ORM\JoinColumn(nullable=true)
    */
     private $activite;

    



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comentaire", type="text")
     */
    private $comentaire;


  

   

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
     * Set comentaire
     *
     * @param string $comentaire
     *
     * @return commentaire
     */
    public function setComentaire($comentaire)
    {
        $this->comentaire = $comentaire;

        return $this;
    }

    /**
     * Get comentaire
     *
     * @return string
     */
    public function getComentaire()
    {
        return $this->comentaire;
    }

    /**
     * Set user
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user
     *
     * @return commentaire
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
     * Set activite
     *
     * @param \Activite\ActiviteBundle\Entity\activite $activite
     *
     * @return commentaire
     */
    public function setActivite(\Activite\ActiviteBundle\Entity\activite $activite = null)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return \Activite\ActiviteBundle\Entity\activite
     */
    public function getActivite()
    {
        return $this->activite;
    }




    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }
}
