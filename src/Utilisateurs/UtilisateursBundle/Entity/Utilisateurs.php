<?php
namespace Utilisateurs\UtilisateursBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Utilisateurs\UtilisateursBundle\Repository\UtilisateursRepository")
 * @ORM\Table(name="utilisateurs")
 */
class Utilisateurs extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


     /**
    * @ORM\OneToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\Media", cascade={"persist"})
    */
     private $image;


    

    /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\aime", mappedBy="user", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $aime;

    /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\commentaire", mappedBy="user", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $commentaire;

     /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\inscription", mappedBy="user", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $inscription;

     /**
    * @ORM\OneToMany(targetEntity="Activite\ActiviteBundle\Entity\vote", mappedBy="user", cascade={"remove"})
    * @ORM\JoinColumn(nullable=true)    
    */
    private $vote;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="promo", type="date")
     */
    private $promo;




    public function __construct()
    {
        parent::__construct();
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adresses = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Ecommerce\EcommerceBundle\Entity\Commandes", mappedBy="utilisateur", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $commandes;
    
    /**
     * @ORM\OneToMany(targetEntity="Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses", mappedBy="utilisateur", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    public $adresses;

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
     * Add commandes
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Commandes $commandes
     * @return Utilisateurs
     */
    public function addCommande(\Ecommerce\EcommerceBundle\Entity\Commandes $commandes)
    {
        $this->commandes[] = $commandes;

        return $this;
    }

    /**
     * Remove commandes
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Commandes $commandes
     */
    public function removeCommande(\Ecommerce\EcommerceBundle\Entity\Commandes $commandes)
    {
        $this->commandes->removeElement($commandes);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * Add adresses
     *
     * @param \Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses $adresses
     * @return Utilisateurs
     */
    public function addAdress(\Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses $adresses)
    {
        $this->adresses[] = $adresses;

        return $this;
    }

    /**
     * Remove adresses
     *
     * @param \Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses $adresses
     */
    public function removeAdress(\Ecommerce\EcommerceBundle\Entity\UtilisateursAdresses $adresses)
    {
        $this->adresses->removeElement($adresses);
    }

    /**
     * Get adresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresses()
    {
        return $this->adresses;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set promo
     *
     * @param \DateTime $promo
     *
     * @return Utilisateurs
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return \DateTime
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * Add aime
     *
     * @param \Activite\ActiviteBundle\Entity\aime $aime
     *
     * @return Utilisateurs
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
     * Add commentaire
     *
     * @param \Activite\ActiviteBundle\Entity\commentaire $commentaire
     *
     * @return Utilisateurs
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
     * Add inscription
     *
     * @param \Activite\ActiviteBundle\Entity\inscription $inscription
     *
     * @return Utilisateurs
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
     * Add vote
     *
     * @param \Activite\ActiviteBundle\Entity\vote $vote
     *
     * @return Utilisateurs
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

    /**
     * Set image
     *
     * @param \Ecommerce\EcommerceBundle\Entity\Media $image
     *
     * @return Utilisateurs
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
}
