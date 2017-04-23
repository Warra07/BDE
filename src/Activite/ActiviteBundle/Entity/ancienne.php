<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ancienne
 *
 * @ORM\Table(name="ancienne")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\ancienneRepository")
 */
class ancienne
{
    /**
    * @ORM\OneToOne(targetEntity="Activite\ActiviteBundle\Entity\activite", cascade={"persist"})
    */
    private $activite;

    /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\album", mappedBy="ancienne", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $album;

    /**
     *
     * @ORM\Column(name="date", type="datetime")
     */

    private $date;   


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;


  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->album = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ancienne
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
     * Add album
     *
     * @param \Activite\ActiviteBundle\Entity\album $album
     *
     * @return ancienne
     */
    public function addAlbum(\Activite\ActiviteBundle\Entity\album $album)
    {
        $this->album[] = $album;

        return $this;
    }

    /**
     * Remove album
     *
     * @param \Activite\ActiviteBundle\Entity\album $album
     */
    public function removeAlbum(\Activite\ActiviteBundle\Entity\album $album)
    {
        $this->album->removeElement($album);
    }

    /**
     * Get album
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlbum()
    {
        return $this->album;
    }







    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ancienne
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
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
}
