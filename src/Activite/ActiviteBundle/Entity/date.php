<?php

namespace Activite\ActiviteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * date
 *
 * @ORM\Table(name="date")
 * @ORM\Entity(repositoryClass="Activite\ActiviteBundle\Repository\dateRepository")
 */
class date
{
    


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;



        /**
        * @ORM\ManyToOne(targetEntity="Activite\ActiviteBundle\Entity\en_vote", inversedBy="date")
        * @ORM\JoinColumn(name="envote", referencedColumnName="id")
        */
        private $envote;

    

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return date
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

    /**
     * Set envote
     *
     * @param \Activite\ActiviteBundle\Entity\en_vote $envote
     *
     * @return date
     */
    public function setEnvote(\Activite\ActiviteBundle\Entity\en_vote $envote = null)
    {
        $this->envote = $envote;

        return $this;
    }

    /**
     * Get envote
     *
     * @return \Activite\ActiviteBundle\Entity\en_vote
     */
    public function getEnvote()
    {
        return $this->envote;
    }


            public function __toString(){
        // to show the name of the Category in the select
        return $this->date->format('Y-m-d H:i:s');
        // to show the id of the Category in the select
        // return $this->id;
    }
}
