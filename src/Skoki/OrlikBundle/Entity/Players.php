<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Players
 *
 * @ORM\Table(name="players")
 * @ORM\HasLifecycleCallbacks
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
     * @var ArrayCollection<PlayerGoals> $playerGoals
     *
     * @ORM\OneToMany(targetEntity="Skoki\OrlikBundle\Entity\PlayerGoals", mappedBy="player", cascade={"all"}, orphanRemoval=true)
     */
    private $playerGoals;

    /**
     * @var ArrayCollection<PlayerCards> $playerCards
     *
     * @ORM\OneToMany(targetEntity="Skoki\OrlikBundle\Entity\PlayerCards", mappedBy="player", cascade={"all"}, orphanRemoval=true)
     */
    private $playerCards;


    /**
     * @var string $image
     * @Assert\File( maxSize = "2000000", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playerGoals = new \Doctrine\Common\Collections\ArrayCollection();
        $this->playerCards = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->away = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->firstname . ' ' .$this->lastname;
    }

    /**
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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

    public function isFile($file)
    {
        if (file_exists(dirname($file))) {
            return true;
        } else {
            return false;
        }
    }

//    /**
//     * Set filepic
//     *
//     * @param string $filepath
//     * @return Players
//     */
//    public function setFilepic($filepath)
//    {
//        $this->filepic = $filepath;
//
//        return $this;
//    }
//
//    /**
//     * Get filepic
//     *
//     * @return
//     */
//    public function getFilepic()
//    {
//        return $this->filepic;
//    }


    /**
     * Add playerGoals
     *
     * @param \Skoki\OrlikBundle\Entity\PlayerGoals $playerGoals
     * @return Tournaments
     */
    public function addPlayerGoal(\Skoki\OrlikBundle\Entity\PlayerGoals $playerGoals)
    {
        $this->playerGoals[] = $playerGoals;

        return $this;
    }

    /**
     * Remove playerGoals
     *
     * @param \Skoki\OrlikBundle\Entity\PlayerGoals $playerGoals
     */
    public function removePlayerGoals(\Skoki\OrlikBundle\Entity\PlayerGoals $playerGoals)
    {
        $this->playerGoals->removeElement($playerGoals);
    }

    /**
     * Get playerGoals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayerGoals()
    {
        return $this->playerGoals;
    }

    /**
     * Remove playerGoals
     *
     * @param \Skoki\OrlikBundle\Entity\PlayerGoals $playerGoals
     */
    public function removePlayerGoal(\Skoki\OrlikBundle\Entity\PlayerGoals $playerGoals)
    {
        $this->playerGoals->removeElement($playerGoals);
    }

    /**
     * Add playerCards
     *
     * @param \Skoki\OrlikBundle\Entity\PlayerCards $playerCards
     * @return Players
     */
    public function addPlayerCard(\Skoki\OrlikBundle\Entity\PlayerCards $playerCards)
    {
        $this->playerCards[] = $playerCards;

        return $this;
    }

    /**
     * Remove playerCards
     *
     * @param \Skoki\OrlikBundle\Entity\PlayerCards $playerCards
     */
    public function removePlayerCard(\Skoki\OrlikBundle\Entity\PlayerCards $playerCards)
    {
        $this->playerCards->removeElement($playerCards);
    }

    /**
     * Get playerCards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayerCards()
    {
        return $this->playerCards;
    }

    public function getFullImagePath() {
        return null === $this->image ? null : $this->getUploadRootDir(). $this->image;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }
        if(!$this->id){
            $this->image->move($this->getTmpUploadRootDir(), $this->image->getClientOriginalName());
        }else{
            $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        }
        $this->setImage($this->image->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist()
     */
    public function moveImage()
    {
        if (null === $this->image) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir().$this->image);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
        unlink($this->getFullImagePath());
        rmdir($this->getUploadRootDir());
    }



}
