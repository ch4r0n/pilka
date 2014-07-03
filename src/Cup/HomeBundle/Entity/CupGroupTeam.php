<?php

namespace Cup\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CupGroupTeam
 *
 * @ORM\Table(name="cup_group_team")
 * @ORM\Entity(repositoryClass="Cup\HomeBundle\Repository\CupGroupTeamRepository")
 */
class CupGroupTeam
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
     * @var \Cup\HomeBundle\Entity\CupGroup $cupGroup
     *
     * @ORM\ManyToOne(targetEntity="\Cup\HomeBundle\Entity\CupGroup", inversedBy="groupTeams" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="cup_group", referencedColumnName="id")
     */
    private $cupGroup;

    /**
     * @var \Cup\HomeBundle\Entity\CupTeam $cupTeam
     *
     * @ORM\ManyToOne(targetEntity="\Cup\HomeBundle\Entity\CupTeam", inversedBy="cupGroup" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="cup_team", referencedColumnName="id")
     */
    private $cupTeam;

    /**
     * @var integer
     *
     * @ORM\Column(name="place", type="integer", nullable=true)
     */
    private $place;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cupTeam = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cupGroup = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cupGroup
     *
     * @param CupGroup $cupGroup
     * @return cup_group_team
     */
    public function setCupGroup($cupGroup)
    {
        $this->cupGroup = $cupGroup;

        return $this;
    }

    /**
     * Get cupGroup
     *
     * @return CupGroup
     */
    public function getCupGroup()
    {
        return $this->cupGroup;
    }

    /**
     * Set cupTeam
     *
     * @param CupTeam $cupTeam
     * @return cup_group_team
     */
    public function setCupTeam($cupTeam)
    {
        $this->cupTeam = $cupTeam;

        return $this;
    }

    /**
     * Get cupTeam
     *
     * @return CupTeam
     */
    public function getCupTeam()
    {
        return $this->cupTeam;
    }

    /**
     * Set place
     *
     * @param integer $place
     * @return cup_group_team
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer 
     */
    public function getPlace()
    {
        return $this->place;
    }
}
