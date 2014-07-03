<?php

namespace Cup\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beat
 *
 * @ORM\Table(name="beat")
 * @ORM\Entity(repositoryClass="Cup\HomeBundle\Repository\BeatRepository")
 */
class Beat
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
     * @var ArrayCollection<UserBeats> $cupUser
     *
     * @ORM\OneToMany(targetEntity="Cup\HomeBundle\Entity\UserBeats", mappedBy="cup_beat", cascade={"all"}, orphanRemoval=true)
     */
    private $cupUser;

    /**
     * @var string
     *
     * @ORM\Column(name="beat", type="string", length=100)
     */
    private $beat;


    private $cupMatch;
    /**
     * @var boolean
     *
     * @ORM\Column(name="win", type="boolean")
     */
    private $win;


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
     * Set cupMatch
     *
     * @param integer $cupMatch
     * @return Beat
     */
    public function setCupMatch($cupMatch)
    {
        $this->cupMatch = $cupMatch;

        return $this;
    }

    /**
     * Get cupMatch
     *
     * @return integer 
     */
    public function getCupMatch()
    {
        return $this->cupMatch;
    }

    /**
     * Set cupUser
     *
     * @param integer $cupUser
     * @return Beat
     */
    public function setCupUser($cupUser)
    {
        $this->cupUser = $cupUser;

        return $this;
    }

    /**
     * Get cupUser
     *
     * @return integer 
     */
    public function getCupUser()
    {
        return $this->cupUser;
    }

    /**
     * Set beat
     *
     * @param string $beat
     * @return Beat
     */
    public function setBeat($beat)
    {
        $this->beat = $beat;

        return $this;
    }

    /**
     * Get beat
     *
     * @return string 
     */
    public function getBeat()
    {
        return $this->beat;
    }

    /**
     * Set win
     *
     * @param boolean $win
     * @return Beat
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return boolean 
     */
    public function getWin()
    {
        return $this->win;
    }
}
