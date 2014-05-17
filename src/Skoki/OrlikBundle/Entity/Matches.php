<?php

namespace Orlik\HomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Orlik\HomepageBundle\Entity\TeamMatches;

/**
 * Matches
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Orlik\HomepageBundle\Repository\MatchesRepository")
 */
class Matches
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="TeamMatches", mappedBy="match_id")
//     * @ORM\JoinColumn(name="id", referencedColumnName="match_id")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="home", type="integer")
     */
    private $home;

    /**
     * @var integer
     *
     * @ORM\Column(name="away", type="integer")
     */
    private $away;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="matchDate", type="datetime", nullable=true)
     */
    private $matchDate;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", length=10, nullable=true)
     */
    private $result;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_home", type="integer", nullable=true)
     */
    private $scoreHome;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_away", type="integer", nullable=true)
     */
    private $scoreAway;

    /**
     * @var integer
     *
     * @ORM\Column(name="red_home", type="integer", nullable=true)
     */
    private $redHome;

    /**
     * @var integer
     *
     * @ORM\Column(name="red_away", type="integer", nullable=true)
     */
    private $redAway;

    /**
     * @var integer
     *
     * @ORM\Column(name="yellow_home", type="integer", nullable=true)
     */
    private $yellowHome;

    /**
     * @var integer
     *
     * @ORM\Column(name="yellow_away", type="integer", nullable=true)
     */
    private $yellowAway;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Rounds", inversedBy="roundMatches")
     * @ORM\JoinColumn(name="round", referencedColumnName="id")
     */
    private $rounds;

    /**
     * @var time - match day time
     */
    private $hour;

    /**
     * @var array
     */
    private $teamMatches;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->matchTeams = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->away = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set id
     *
     * @param integer $id
     * @return Matches
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get hour
     *
     * @return time
     */
    public function getHour()
    {
        $hour = date('H:i', $this->getMatchDate());
        return $hour;
    }

    /**
     * Set home
     *
     * @param integer $home
     * @return Matches
     */
    public function setHome($home)
    {
        $this->home = $home;
    
        return $this;
    }

    /**
     * Get home
     *
     * @return integer 
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set away
     *
     * @param integer $away
     * @return Matches
     */
    public function setAway($away)
    {
        $this->away = $away;
    
        return $this;
    }

    /**
     * Get away
     *
     * @return integer 
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Matches
     */
    public function setDate(\DateTime $date = null)
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
     * Set result
     *
     * @param string $result
     * @return Matches
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
     * Set scoreHome
     *
     * @param integer $scoreHome
     */
    public function setScoreHome($scoreHome)
    {
        $this->scoreHome = $scoreHome;
    }

    /**
     * Get scoreHome
     *
     * @return integer 
     */
    public function getScoreHome()
    {
        return $this->scoreHome;
    }

    /**
     * Set scoreAway
     *
     * @param integer $scoreAway
     * @return Matches
     */
    public function setScoreAway($scoreAway)
    {
        $this->scoreAway = $scoreAway;
    
        return $this;
    }

    /**
     * Get scoreAway
     *
     * @return integer 
     */
    public function getScoreAway()
    {
        return $this->scoreAway;
    }

    /**
     * Set redHome
     *
     * @param integer $redHome
     * @return Matches
     */
    public function setRedHome($redHome)
    {
        $this->redHome = $redHome;
    
        return $this;
    }

    /**
     * Get redHome
     *
     * @return integer 
     */
    public function getRedHome()
    {
        return $this->redHome;
    }

    /**
     * Set redAway
     *
     * @param integer $redAway
     * @return Matches
     */
    public function setRedAway($redAway)
    {
        $this->redAway = $redAway;
    
        return $this;
    }

    /**
     * Get redAway
     *
     * @return integer 
     */
    public function getRedAway()
    {
        return $this->redAway;
    }

    /**
     * Set yellowHome
     *
     * @param integer $yellowHome
     * @return Matches
     */
    public function setYellowHome($yellowHome)
    {
        $this->yellowHome = $yellowHome;
    
        return $this;
    }

    /**
     * Get yellowHome
     *
     * @return integer 
     */
    public function getYellowHome()
    {
        return $this->yellowHome;
    }

    /**
     * Set yellowAway
     *
     * @param integer $yellowAway
     * @return Matches
     */
    public function setYellowAway($yellowAway)
    {
        $this->yellowAway = $yellowAway;
    
        return $this;
    }

    /**
     * Get yellowAway
     *
     * @return integer 
     */
    public function getYellowAway()
    {
        return $this->yellowAway;
    }

    /**
     * Add home
     *
     * @param \Orlik\HomepageBundle\Entity\teamMatches $home
     * @return Matches
     */
    public function addHome(\Orlik\HomepageBundle\Entity\TeamMatches $home)
    {
        $this->home[] = $home;
    
        return $this;
    }

    /**
     * Remove home
     *
     * @param \Orlik\HomepageBundle\Entity\TeamMatches $home
     */
    public function removeHome(\Orlik\HomepageBundle\Entity\TeamMatches $home)
    {
        $this->home->removeElement($home);
    }

    /**
     * Add away
     *
     * @param \Orlik\HomepageBundle\Entity\TeamMatches $away
     * @return Matches
     */
    public function addAway(\Orlik\HomepageBundle\Entity\TeamMatches $away)
    {
        $this->away[] = $away;
    
        return $this;
    }

    /**
     * Remove away
     *
     * @param \Orlik\HomepageBundle\Entity\TeamMatches $away
     */
    public function removeAway(\Orlik\HomepageBundle\Entity\TeamMatches $away)
    {
        $this->away->removeElement($away);
    }

    /**
     * Add matchTeams
     *
     * @param \Orlik\HomepageBundle\Entity\TeamMatches $matchTeams
     * @return Matches
     */
    public function addMatchTeam(\Orlik\HomepageBundle\Entity\TeamMatches $matchTeams)
    {
        $this->matchTeams[] = $matchTeams;
    
        return $this;
    }

    /**
     * Remove matchTeams
     *
     * @param \Orlik\HomepageBundle\Entity\TeamMatches $matchTeams
     */
    public function removeMatchTeam(\Orlik\HomepageBundle\Entity\TeamMatches $matchTeams)
    {
        $this->matchTeams->removeElement($matchTeams);
    }

    /**
     * Get matchTeams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatchTeams()
    {
        return $this->matchTeams;
    }

    /**
     * Add TeamMatches
     *
     * @param \Orlik\HomepageBundle\Entity\TeamMatches $teamMatches
     * @return Matches
     */
    public function addTeamMatches(\Orlik\HomepageBundle\Entity\TeamMatches $teamMatches)
    {
        $this->matchTeams[] = $teamMatches;
    
        return $this;
    }

    /**
     * Remove teamMatches
     *
     * @param \Orlik\HomepageBundle\Entity\teamMatches $teamMatches
     */
    public function removeTeamMatches(\Orlik\HomepageBundle\Entity\TeamMatches $teamMatches)
    {
        $this->matchTeams->removeElement($teamMatches);
    }

    /**
     * Set rounds
     *
     * @param \Orlik\HomepageBundle\Entity\Rounds $rounds
     * @return Matches
     */
    public function setRounds(\Orlik\HomepageBundle\Entity\Rounds $rounds = null)
    {
        $this->rounds = $rounds;
    
        return $this;
    }

    /**
     * Get rounds
     *
     * @return \Orlik\HomepageBundle\Entity\Rounds 
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Get round id
     *
     * @return integer
     */
    public function getRoundId()
    {
        return $this->rounds->getId();
    }

    /**
     * Get round id
     *
     * @return integer
     */
    public function getRoundOrder()
    {
        return $this->rounds->getTorder();
    }

    /**
     * Set matchDate
     *
     * @param \DateTime $matchDate
     * @return Matches
     */
    public function setMatchDate($matchDate)
    {
        $this->matchDate = $matchDate;
    
        return $this;
    }

    /**
     * Get matchDate
     *
     * @return \DateTime 
     */
    public function getMatchDate()
    {
        return $this->matchDate;
    }
}