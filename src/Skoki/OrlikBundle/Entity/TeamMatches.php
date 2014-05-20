<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Skoki\OrlikBundle\Entity\Tournaments;
use Skoki\OrlikBundle\Entity\Teams;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * Skoki\OrlikBundle\Entity\TeamMatches
 *
 * TournamentTeams
 *
 * @ORM\Table(name="team_matches")
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Repository\TeamMatchesRepository")
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
     * @var \Skoki\OrlikBundle\Entity\Teams $team
     *
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Teams", inversedBy="teamMatches")
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
     * @var \Skoki\OrlikBundle\Entity\Matches $match
     *
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Matches", inversedBy="rounds")
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
     * @param \Skoki\OrlikBundle\Entity\Tournaments $tournamentId
     * @return TournamentTeams
     */
    public function addTournamentId(\Skoki\OrlikBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournamentId[] = $tournamentId;

        return $this;
    }

    /**
     * Remove tournamentId
     *
     * @param \Skoki\OrlikBundle\Entity\Tournaments $tournamentId
     */
    public function removeTournamentId(\Skoki\OrlikBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournamentId->removeElement($tournamentId);
    }
//    /**
//     * Add teamId
//     *
//     * @param \Skoki\OrlikBundle\Entity\Teams $teamId
//     * @return TournamentTeams
//     */
//    public function addTeamId(\Skoki\OrlikBundle\Entity\Teams $teamId)
//    {
//        $this->teamId[] = $teamId;
//
//        return $this;
//    }
//
//    /**
//     * Remove teamId
//     *
//     * @param \Skoki\OrlikBundle\Entity\Teams $teamId
//     */
//    public function removeTeamId(\Skoki\OrlikBundle\Entity\Teams $teamId)
//    {
//        $this->teamId->removeElement($teamId);
//    }

    /**
     * Set tournament
     *
     * @param \Skoki\OrlikBundle\Entity\Tournaments $tournament
     * @return TournamentTeams
     */
    public function setTournament(\Skoki\OrlikBundle\Entity\Tournaments $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \Skoki\OrlikBundle\Entity\Tournaments
     */
    public function getTournament()
    {
        return $this->tournament;
    }

//    /**
//     * Set team
//     *
//     * @param \Skoki\OrlikBundle\Entity\Teams $team
//     * @return TournamentTeams
//     */
//    public function setTeam(\Skoki\OrlikBundle\Entity\Teams $team = null)
//    {
//        $this->team = $team;
//
//        return $this;
//    }

//    /**
//     * Get team
//     *
//     * @return \Skoki\OrlikBundle\Entity\Teams
//     */
//    public function getTeam()
//    {
//        return $this->team;
//    }

    /**
     * Set home
     *
     * @param \Skoki\OrlikBundle\Entity\Teams $homeId
     * @return TeamMatches
     */
    public function setHome(\Skoki\OrlikBundle\Entity\Teams $homeId = null)
    {
        $this->home = $homeId;
    
        return $this;
    }

    /**
     * Get home
     *
     * @return \Skoki\OrlikBundle\Entity\Teams 
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set away
     *
     * @param \Skoki\OrlikBundle\Entity\Teams $awayId
     * @return TeamMatches
     */
    public function setAway(\Skoki\OrlikBundle\Entity\Teams $awayId = null)
    {
        $this->away = $awayId;
    
        return $this;
    }

    /**
     * Get awayId
     *
     * @return \Skoki\OrlikBundle\Entity\Teams 
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
     * @param \Skoki\OrlikBundle\Entity\Teams $team
     * @return TeamMatches
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
}
