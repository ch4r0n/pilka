<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Players
 *
 * @ORM\Table(name="players")
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Repository\PlayersRepository")
 */
class Players
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100, nullable=true)
     */
    private $lastname;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Teams", inversedBy="players")
     * @ORM\JoinColumn(name="team", referencedColumnName="id")
     */
    private $team;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var integer
     *
     * @ORM\Column(name="numer", type="integer", nullable=true)
     */
    private $numer;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="pozycja", type="string", length=100, nullable=true)
     */
    private $pozycja;

    /**
     * @var string
     *
     * @ORM\Column(name="other", type="text", nullable=true)
     */
    private $other;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->firstname . ' ' .$this->lastname;
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
     * Set firstname
     *
     * @param string $firstname
     * @return Players
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Players
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Players
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Players
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Players
     */
    public function setHeight($height)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set numer
     *
     * @param integer $numer
     * @return Players
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;

        return $this;
    }

    /**
     * Get numer
     *
     * @return integer
     */
    public function getNumer()
    {
        return $this->numer;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Players
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set other
     *
     * @param string $other
     * @return Players
     */
    public function setOther($other)
    {
        $this->other = $other;
    
        return $this;
    }

    /**
     * Get other
     *
     * @return string 
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Set teamId
     *
     * @param integer $teamId
     * @return Players
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    
        return $this;
    }

    /**
     * Get teamId
     *
     * @return integer 
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * Set team
     *
     * @param \Skoki\OrlikBundle\Entity\Teams $team
     * @return Players
     */
    public function setTeam(\Skoki\OrlikBundle\Entity\Teams $team = null)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get team
     *
     * @return \Skoki\OrlikBundle\Entity\Teams 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set pozycja
     *
     * @param string $pozycja
     * @return Players
     */
    public function setPozycja($pozycja)
    {
        $this->pozycja = $pozycja;

        return $this;
    }

    /**
     * Get pozycja
     *
     * @return string 
     */
    public function getPozycja()
    {
        return $this->pozycja;
    }
}
