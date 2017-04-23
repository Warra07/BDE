<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * activite
 *
 * @ORM\Table(name="activite")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\activiteRepository")
 */
class activite
{
    /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\commentaire", mappedBy="activite", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $commentaire;


        /**
     *
     * @ORM\Column(name="datelimite", type="datetime")
     */

    private $datelimite;

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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var string
     *
     * @ORM\Column(name="payante", type="integer", length=255) 
     */
    private $payante;


   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaire = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return activite
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return activite
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set payante
     *
     * @param integer $payante
     *
     * @return activite
     */
    public function setPayante($payante)
    {
        $this->payante = $payante;

        return $this;
    }

    /**
     * Get payante
     *
     * @return integer
     */
    public function getPayante()
    {
        return $this->payante;
    }

    /**
     * Add commentaire
     *
     * @param \Activite\ActiviteBundle\Entity\commentaire $commentaire
     *
     * @return activite
     */
    public function addCommentaire(\Activite\ActiviteBundle\Entity\commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Activite\ActiviteBundle\Entity\commentaire $commentaire
     */
    public function removeCommentaire(\Activite\ActiviteBundle\Entity\commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Get commentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set image
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Media $image
     *
     * @return activite
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

    /**
     * Set datelimite
     *
     * @param \DateTime $datelimite
     *
     * @return activite
     */
    public function setDatelimite($datelimite)
    {
        $this->datelimite = $datelimite;

        return $this;
    }

    /**
     * Get datelimite
     *
     * @return \DateTime
     */
    public function getDatelimite()
    {
        return $this->datelimite;
    }
}
