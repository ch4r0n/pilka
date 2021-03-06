<?php

namespace Cup\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserBeats
 *
 * @ORM\Table(name="userbeats")
 * @ORM\Entity(repositoryClass="Cup\HomeBundle\Repository\UserBeatsRepository")
 */
class UserBeats
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
     * @var integer
     *
     * @ORM\Column(name="cup_user", type="integer")
     */
    private $cupUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="cup_beat", type="integer")
     */
    private $cupBeat;

    /**
     * @var \Cup\HomeBundle\Entity\CupMatch $cupMatch
     *
     * @ORM\ManyToOne(targetEntity="\Cup\HomeBundle\Entity\CupMatch", inversedBy="cupMatchBeats" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="cup_match", referencedColumnName="id")
     */
    private $cupMatch;

    /**
     * @var boolean
     *
     * @ORM\Column(name="win", type="boolean", nullable=true)
     */
    private $win;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cupMatch = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cupUser
     *
     * @param integer $cupUser
     * @return UserBeats
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
     * Set cupBeat
     *
     * @param integer $cupBeat
     * @return UserBeats
     */
    public function setCupBeat($cupBeat)
    {
        $this->cupBeat = $cupBeat;

        return $this;
    }

    /**
     * Get cupBeat
     *
     * @return integer 
     */
    public function getCupBeat()
    {
        return $this->cupBeat;
    }

    /**
     * Set win
     *
     * @param boolean $win
     * @return UserBeats
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
    /**
     * Set cupMatch
     *
     * @param integer $cupMatch
     * @return UserBeats
     */
    public function setCupMatch($cupMatch)
    {
        $this->cupMatch = $cupMatch;

        return $this;
    }

    /**
     * Get cupBeat
     *
     * @return integer
     */
    public function getCupMatch()
    {
        return $this->cupMatch;
    }
}
