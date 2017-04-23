<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\albumRepository")
 */
class album
{

   /**
    * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs")
    */
  
    private $user;

    /**
    * @ORM\ManyToOne(targetEntity="Activite\ActiviteBundle\Entity\ancienne", inversedBy="album")
    */
    private $ancienne;

    /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\aime", mappedBy="album", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $aime;

    /**
    * @ORM\OneToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Media", cascade={"persist"})
    */
    private $image;
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
        $this->aime = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set user
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $user
     *
     * @return album
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
     * Set ancienne
     *
     * @param \Activite\ActiviteBundle\Entity\ancienne $ancienne
     *
     * @return album
     */
    public function setAncienne(\Activite\ActiviteBundle\Entity\ancienne $ancienne = null)
    {
        $this->ancienne = $ancienne;

        return $this;
    }

    /**
     * Get ancienne
     *
     * @return \Activite\ActiviteBundle\Entity\ancienne
     */
    public function getAncienne()
    {
        return $this->ancienne;
    }

    /**
     * Add aime
     *
     * @param \Activite\ActiviteBundle\Entity\aime $aime
     *
     * @return album
     */
    public function addAime(\Activite\ActiviteBundle\Entity\aime $aime)
    {
        $this->aime[] = $aime;

        return $this;
    }

    /**
     * Remove aime
     *
     * @param \Activite\ActiviteBundle\Entity\aime $aime
     */
    public function removeAime(\Activite\ActiviteBundle\Entity\aime $aime)
    {
        $this->aime->removeElement($aime);
    }

    /**
     * Get aime
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAime()
    {
        return $this->aime;
    }

    /**
     * Set image
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Media $image
     *
     * @return album
     */
    public function setImage(\Ecommerce\EcommerceBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Ecommerce\EcommerceBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }



            public function __toString(){
        // to show the name of the Category in the select
        return $this->image->getName();
        // to show the id of the Category in the select
        // return $this->id;
    }
}
