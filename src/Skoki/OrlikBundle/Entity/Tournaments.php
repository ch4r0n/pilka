<?php

namespace Orlik\HomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Orlik\HomepageBundle\Entity\TournamentsTeams;

/**
 * Tournaments
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Orlik\HomepageBundle\Repository\TournamentsRepository")
 */
class Tournaments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="TournamentTeams", mappedBy="tournament_id")
     * @ORM\JoinColumn(name="id", referencedColumnName="tournament_id")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var integer
     *
     * @ORM\Column(name="rounds", type="integer", nullable=true)
     */
    private $roundsNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rematch", type="boolean", nullable=true)
     */
    private $rematch;

    /**
     * @var string
     *
     * @ORM\Column(name="rules", type="text", nullable=true)
     */
    private $rules;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin_date", type="date", nullable=true)
     */
    private $beginDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="other", type="string", length=255, nullable=true)
     */
    private $other;

    /**
     * @var ArrayCollection<TournamentTeams> $teamTournament
     *
     * @ORM\OneToMany(targetEntity="Orlik\HomepageBundle\Entity\TournamentTeams", mappedBy="tournament_id", cascade={"all"}, orphanRemoval=true)
     */
    private $tournamentTeams;

    /**
     * @var ArrayCollection $rounds
     * @ORM\OneToMany(targetEntity="Rounds", mappedBy="tournament")
     */
    protected $rounds;

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
     * @return Tournamenr
     */
    public function setId($id = null)
    {
        if ($id != null) {
            $this->id = $id;
        }
        return $this;
    }
    /**
     * Set name
     *
     * @param string $name
     * @return Tournaments
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Tournaments
     */
    public function setPlace($place)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set roundsNumber
     *
     * @param integer $roundsNumber
     * @return Tournaments
     */
    public function setRoundsNumber($roundsNumber)
    {
        $this->roundsNumber = $roundsNumber;
    
        return $this;
    }

    /**
     * Get roundsNumber
     *
     * @return integer 
     */
    public function getRoundsNumber()
    {
        return $this->roundsNumber;
    }

    /**
     * Set rules
     *
     * @param string $rules
     * @return Tournaments
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    
        return $this;
    }

    /**
     * Get rules
     *
     * @return string 
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Set beginDate
     *
     * @param \DateTime $beginDate
     * @return Tournaments
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;
    
        return $this;
    }

    /**
     * Get beginDate
     *
     * @return \DateTime 
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Tournaments
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set other
     *
     * @param string $other
     * @return Tournaments
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
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tournament = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rounds = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rematch = true;
    }
    
    /**
     * Add teams
     *
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $teams
     * @return Tournaments
     */
    public function addTeam(\Orlik\HomepageBundle\Entity\TournamentTeams $teams)
    {
        $this->teams[] = $teams;
    
        return $this;
    }

    /**
     * Remove teams
     *
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $teams
     */
    public function removeTeam(\Orlik\HomepageBundle\Entity\TournamentTeams $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set teams
     *
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $teams
     * @return Tournaments
     */
    public function setTeams(\Orlik\HomepageBundle\Entity\TournamentTeams $teams = null)
    {
        $this->teams = $teams;
    
        return $this;
    }

    /**
     * Add tournamentTeams
     *
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $tournamentTeams
     * @return Tournaments
     */
    public function addTournamentTeam(\Orlik\HomepageBundle\Entity\TournamentTeams $tournamentTeams)
    {
        $this->tournamentTeams[] = $tournamentTeams;
    
        return $this;
    }

    /**
     * Remove tournamentTeams
     *
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $tournamentTeams
     */
    public function removeTournamentTeam(\Orlik\HomepageBundle\Entity\TournamentTeams $tournamentTeams)
    {
        $this->tournamentTeams->removeElement($tournamentTeams);
    }

    /**
     * Get tournamentTeams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTournamentTeams()
    {
        return $this->tournamentTeams;
    }

    /**
     * Add rounds
     *
     * @param \Orlik\HomepageBundle\Entity\Rounds $rounds
     * @return Tournaments
     */
    public function addRound(\Orlik\HomepageBundle\Entity\Rounds $rounds)
    {
        $this->rounds[] = $rounds;
    
        return $this;
    }

    /**
     * Remove rounds
     *
     * @param \Orlik\HomepageBundle\Entity\Rounds $rounds
     */
    public function removeRound(\Orlik\HomepageBundle\Entity\Rounds $rounds)
    {
        $this->rounds->removeElement($rounds);
    }

    /**
     * Get rounds
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Set rematch
     *
     * @param boolean $rematch
     * @return Tournaments
     */
    public function setRematch($rematch)
    {
        $this->rematch = $rematch;
    
        return $this;
    }

    /**
     * Get rematch
     *
     * @return boolean 
     */
    public function getRematch()
    {
        return $this->rematch;
    }
}