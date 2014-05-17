<?php

namespace Orlik\HomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Orlik\HomepageBundle\Entity\Tournaments;
use Orlik\HomepageBundle\Entity\Teams;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * Orlik\HomepageBundle\Entity\TeamMatches
 *
 * TournamentTeams
 *
 * @ORM\Table(name="team_matches")
 * @ORM\Entity(repositoryClass="Orlik\HomepageBundle\Repository\TeamMatchesRepository")
 */
class TeamMatches
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Orlik\HomepageBundle\Entity\Teams $team
     *
     * @ORM\ManyToOne(targetEntity="\Orlik\HomepageBundle\Entity\Teams", inversedBy="teamMatches")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    protected $team;


    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    protected $type;


    /**
     * @var \Orlik\HomepageBundle\Entity\Matches $match
     *
     * @ORM\ManyToOne(targetEntity="\Orlik\HomepageBundle\Entity\Matches", inversedBy="rounds")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     */
    protected $match;

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
     * Set match
     *
     * @param integer $matchId
     * @return TeamMatches
     */
    public function setMatch($matchId)
    {
        $this->match = $matchId;

        return $this;
    }

    /**
     * Get matchId
     *
     * @return integer
     */
    public function getMatch()
    {
        return $this->$match;
    }

//    /**
//     * Set teamId
//     *
//     * @param integer $teamId
//     * @return TournamentTeams
//     */
//    public function setTeamId($teamId)
//    {
//        $this->teamId = $teamId;
//
//        return $this;
//    }
//
//    /**
//     * Get teamId
//     *
//     * @return integer
//     */
//    public function getTeamId()
//    {
//        return $this->teamId;
//    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->home = new \Doctrine\Common\Collections\ArrayCollection();
        $this->away = new \Doctrine\Common\Collections\ArrayCollection();
        $this->match = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tournamentId
     *
     * @param \Orlik\HomepageBundle\Entity\Tournaments $tournamentId
     * @return TournamentTeams
     */
    public function addTournamentId(\Orlik\HomepageBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournamentId[] = $tournamentId;

        return $this;
    }

    /**
     * Remove tournamentId
     *
     * @param \Orlik\HomepageBundle\Entity\Tournaments $tournamentId
     */
    public function removeTournamentId(\Orlik\HomepageBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournamentId->removeElement($tournamentId);
    }
//    /**
//     * Add teamId
//     *
//     * @param \Orlik\HomepageBundle\Entity\Teams $teamId
//     * @return TournamentTeams
//     */
//    public function addTeamId(\Orlik\HomepageBundle\Entity\Teams $teamId)
//    {
//        $this->teamId[] = $teamId;
//
//        return $this;
//    }
//
//    /**
//     * Remove teamId
//     *
//     * @param \Orlik\HomepageBundle\Entity\Teams $teamId
//     */
//    public function removeTeamId(\Orlik\HomepageBundle\Entity\Teams $teamId)
//    {
//        $this->teamId->removeElement($teamId);
//    }

    /**
     * Set tournament
     *
     * @param \Orlik\HomepageBundle\Entity\Tournaments $tournament
     * @return TournamentTeams
     */
    public function setTournament(\Orlik\HomepageBundle\Entity\Tournaments $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \Orlik\HomepageBundle\Entity\Tournaments
     */
    public function getTournament()
    {
        return $this->tournament;
    }

//    /**
//     * Set team
//     *
//     * @param \Orlik\HomepageBundle\Entity\Teams $team
//     * @return TournamentTeams
//     */
//    public function setTeam(\Orlik\HomepageBundle\Entity\Teams $team = null)
//    {
//        $this->team = $team;
//
//        return $this;
//    }

//    /**
//     * Get team
//     *
//     * @return \Orlik\HomepageBundle\Entity\Teams
//     */
//    public function getTeam()
//    {
//        return $this->team;
//    }

    /**
     * Set home
     *
     * @param \Orlik\HomepageBundle\Entity\Teams $homeId
     * @return TeamMatches
     */
    public function setHome(\Orlik\HomepageBundle\Entity\Teams $homeId = null)
    {
        $this->home = $homeId;
    
        return $this;
    }

    /**
     * Get home
     *
     * @return \Orlik\HomepageBundle\Entity\Teams 
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set away
     *
     * @param \Orlik\HomepageBundle\Entity\Teams $awayId
     * @return TeamMatches
     */
    public function setAway(\Orlik\HomepageBundle\Entity\Teams $awayId = null)
    {
        $this->away = $awayId;
    
        return $this;
    }

    /**
     * Get awayId
     *
     * @return \Orlik\HomepageBundle\Entity\Teams 
     */
    public function getAway()
    {
        return $this->away;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return TeamMatches
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set team
     *
     * @param \Orlik\HomepageBundle\Entity\Teams $team
     * @return TeamMatches
     */
    public function setTeam(\Orlik\HomepageBundle\Entity\Teams $team = null)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get team
     *
     * @return \Orlik\HomepageBundle\Entity\Teams 
     */
    public function getTeam()
    {
        return $this->team;
    }
}