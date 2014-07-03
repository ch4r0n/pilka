<?php

namespace Cup\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cup_match
 *
 * @ORM\Table(name="cup_match")
 * @ORM\Entity(repositoryClass="Cup\HomeBundle\Repository\CupMatchRepository")
 */
class CupMatch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="CupTeamMatch", mappedBy="cup_match")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cup_group", type="integer")
     */
    private $cupGroup;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="match_date", type="datetime", length=255)
     */
    private $matchDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="team_home", type="integer")
     * @ORM\OneToOne(targetEntity="CupTeam", mappedBy="cup_match")
     */
    private $teamHome;

    /**
     * @var integer
     *
     * @ORM\Column(name="team_away", type="integer")
     * @ORM\OneToOne(targetEntity="CupTeam", mappedBy="cup_match")
     */
    private $teamAway;

    /**
     * @var integer
     *
     * @ORM\Column(name="home_score", type="integer", nullable=true)
     */
    private $homeScore;

    /**
     * @var integer
     *
     * @ORM\Column(name="away_score", type="integer", nullable=true)
     */
    private $awayScore;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", nullable=true)
     */
    private $result;

    /**
     * @var ArrayCollection<CupTeamMatch> $matchTeam
     * @ORM\OneToMany(targetEntity="Cup\HomeBundle\Entity\CupTeamMatch", mappedBy="cup_match", cascade={"all"}, orphanRemoval=true)
     */
    private $matchTeam;

    /**
     * @var ArrayCollection<UserBeats> $cupMatchBeats
     *
     * @ORM\OneToMany(targetEntity="Cup\HomeBundle\Entity\UserBeats", mappedBy="cup_match", cascade={"all"}, orphanRemoval=true)
     */
    private $cupMatchBeats;

    public function __toString()
    {
        return $this->teamHome . ' - ' . $this->teamAway . '  ';
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
     * @param integer $cupGroup
     * @return cup_match
     */
    public function setCupGroup($cupGroup)
    {
        $this->cupGroup = $cupGroup;

        return $this;
    }

    /**
     * Get cupGroup
     *
     * @return integer 
     */
    public function getCupGroup()
    {
        return $this->cupGroup;
    }

    /**
     * Set matchDate
     *
     * @param string $matchDate
     * @return cup_match
     */
    public function setMatchDate($matchDate)
    {
        $this->matchDate = $matchDate;

        return $this;
    }

    /**
     * Get matchDate
     *
     * @return string 
     */
    public function getMatchDate()
    {
        return $this->matchDate;
    }

    /**
     * Set teamHome
     *
     * @param integer $teamHome
     * @return cup_match
     */
    public function setTeamHome($teamHome)
    {
        $this->teamHome = $teamHome;

        return $this;
    }

    /**
     * Get teamHome
     *
     * @return integer 
     */
    public function getTeamHome()
    {
        return $this->teamHome;
    }

    /**
     * Set result
     *
     * @param string $result
     *
     * @return cup_match
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }
        /**
     * Set teamAway
     *
     * @param integer $teamAway
     * @return cup_match
     */
    public function setTeamAway($teamAway)
    {
        $this->teamAway = $teamAway;

        return $this;
    }

    /**
     * Get teamAway
     *
     * @return integer 
     */
    public function getTeamAway()
    {
        return $this->teamAway;
    }

    /**
     * Set homeScore
     *
     * @param integer $homeScore
     * @return cup_match
     */
    public function setHomeScore($homeScore)
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    /**
     * Get homeScore
     *
     * @return integer 
     */
    public function getHomeScore()
    {
        return $this->homeScore;
    }

    /**
     * Set awayScore
     *
     * @param integer $awayScore
     * @return cup_match
     */
    public function setAwayScore($awayScore)
    {
        $this->awayScore = $awayScore;

        return $this;
    }

    /**
     * Get awayScore
     *
     * @return integer 
     */
    public function getAwayScore()
    {
        return $this->awayScore;
    }
}
