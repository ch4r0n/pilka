<?php

namespace Cup\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cup_team_match
 *
 * @ORM\Table(name="cup_team_match")
 * @ORM\Entity(repositoryClass="Cup\HomeBundle\Repository\CupTeamMatchRepository")
 */
class CupTeamMatch
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
     * @var \Cup\HomeBundle\Entity\CupTeam $cupTeam
     *
     * @ORM\ManyToOne(targetEntity="\Cup\HomeBundle\Entity\CupTeam", inversedBy="cupMatch" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="cup_team", referencedColumnName="id")
     */
    private $cupTeam;

    /**
     * @var \Cup\HomeBundle\Entity\CupMatch $cupTeam
     *
     * @ORM\ManyToOne(targetEntity="\Cup\HomeBundle\Entity\CupMatch", inversedBy="matchTeam" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="cup_match", referencedColumnName="id")
     */
    private $cupMatch;


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
     * Set cupTeam
     *
     * @param integer $cupTeam
     * @return cup_team_match
     */
    public function setCupTeam($cupTeam)
    {
        $this->cupTeam = $cupTeam;

        return $this;
    }

    /**
     * Get cupTeam
     *
     * @return integer 
     */
    public function getCupTeam()
    {
        return $this->cupTeam;
    }

    /**
     * Set cupMatch
     *
     * @param integer $cupMatch
     * @return cup_team_match
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
}
