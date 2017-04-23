<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * valide
 *
 * @ORM\Table(name="valide")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\valideRepository")
 */
class valide
{
    /**
    * @ORM\OneToOne(targetEntity="Activite\ActiviteBundle\Entity\activite", cascade={"persist"})
    */
    private $activite;

    /**
     *
     * @ORM\Column(name="datechoisis", type="datetime")
     */
      private $datechoisis;


     /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\inscription", mappedBy="valide", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $inscription;

    /**
     * @var int
     *
     * @ORM\Column(name="recurrent", type="boolean")
     */
    private $recurrent;

    /**
     * @var int
     *
     * @ORM\Column(name="nbmax", type="integer")
     */
    private $nbmax;
   

    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


   

  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscription = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set recurrent
     *
     * @param boolean $recurrent
     *
     * @return valide
     */
    public function setRecurrent($recurrent)
    {
        $this->recurrent = $recurrent;

        return $this;
    }

    /**
     * Get recurrent
     *
     * @return boolean
     */
    public function getRecurrent()
    {
        return $this->recurrent;
    }

    /**
     * Set nbmax
     *
     * @param integer $nbmax
     *
     * @return valide
     */
    public function setNbmax($nbmax)
    {
        $this->nbmax = $nbmax;

        return $this;
    }

    /**
     * Get nbmax
     *
     * @return integer
     */
    public function getNbmax()
    {
        return $this->nbmax;
    }

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
     * Set activite
     *
     * @param \Activite\ActiviteBundle\Entity\activite $activite
     *
     * @return valide
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
    /**
     * Add inscription
     *
     * @param \Activite\ActiviteBundle\Entity\inscription $inscription
     *
     * @return valide
     */
    public function addInscription(\Activite\ActiviteBundle\Entity\inscription $inscription)
    {
        $this->inscription[] = $inscription;

        return $this;
    }

    /**
     * Remove inscription
     *
     * @param \Activite\ActiviteBundle\Entity\inscription $inscription
     */
    public function removeInscription(\Activite\ActiviteBundle\Entity\inscription $inscription)
    {
        $this->inscription->removeElement($inscription);
    }

    /**
     * Get inscription
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscription()
    {
        return $this->inscription;
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
