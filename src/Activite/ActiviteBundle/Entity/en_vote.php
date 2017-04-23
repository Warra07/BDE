<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * envote
 *
 * @ORM\Table(name="envote")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\envoteRepository")
 */
class en_vote
{
    /**
    * @ORM\OneToOne(targetEntity="Activite\ActiviteBundle\Entity\activite", cascade={"persist"})
    */
    private $activite;

    /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\date", mappedBy="envote", cascade={"persist", "remove"})  
    */   
     private $date;




    /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\vote", mappedBy="envote", cascade={"persist", "remove"})  
    */   
     private $vote;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
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
    private $nbmin;
  
    

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
     * Set recurrent
     *
     * @param boolean $recurrent
     *
     * @return en_vote
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
     * Set activite
     *
     * @param \Activite\ActiviteBundle\Entity\activite $activite
     *
     * @return en_vote
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
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set ecurrent
     *
     * @param boolean $ecurrent
     *
     * @return en_vote
     */
    public function setEcurrent($ecurrent)
    {
        $this->ecurrent = $ecurrent;

        return $this;
    }

    /**
     * Get ecurrent
     *
     * @return boolean
     */
    public function getEcurrent()
    {
        return $this->ecurrent;
    }

    /**
     * Set nbmin
     *
     * @param integer $nbmin
     *
     * @return en_vote
     */
    public function setNbmin($nbmin)
    {
        $this->nbmin = $nbmin;

        return $this;
    }

    /**
     * Get nbmin
     *
     * @return integer
     */
    public function getNbmin()
    {
        return $this->nbmin;
    }

    /**
     * Add date
     *
     * @param \Activite\ActiviteBundle\Entity\date $date
     *
     * @return en_vote
     */
    public function addDate(\Activite\ActiviteBundle\Entity\date $date)
    {
        $this->date[] = $date;
        $date->setEnvote($this);

        return $this;
    }

    /**
     * Remove date
     *
     * @param \Activite\ActiviteBundle\Entity\date $date
     */
    public function removeDate(\Activite\ActiviteBundle\Entity\date $date)
    {
        $this->date->removeElement($date);
    }

    /**
     * Get date
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDate()
    {
        return $this->date;
    }

        public function __toString(){
        // to show the name of the Category in the select
        return $this->activite->getTitre();
        // to show the id of the Category in the select
        // return $this->id;
    }

    /**
     * Add vote
     *
     * @param \Activite\ActiviteBundle\Entity\vote $vote
     *
     * @return en_vote
     */
    public function addVote(\Activite\ActiviteBundle\Entity\vote $vote)
    {
        $this->vote[] = $vote;

        return $this;
    }

    /**
     * Remove vote
     *
     * @param \Activite\ActiviteBundle\Entity\vote $vote
     */
    public function removeVote(\Activite\ActiviteBundle\Entity\vote $vote)
    {
        $this->vote->removeElement($vote);
    }

    /**
     * Get vote
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVote()
    {
        return $this->vote;
    }
}
