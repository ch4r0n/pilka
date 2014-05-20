<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Skoki\OrlikBundle\Entity\Tournaments;
use Skoki\OrlikBundle\Entity\Teams;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * Skoki\OrlikBundle\Entity\TournamentTeams
 *
 * TournamentTeams
 *
 * @ORM\Table(name="tournament_teams")
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Repository\TournamentTeamsRepository")
 */
class TournamentTeams
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
     * @var \Skoki\OrlikBundle\Entity\Tournaments $tournament
     *
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Tournaments", inversedBy="tournamentTeams" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     */
    protected $tournament;


    /**
     * @var \Skoki\OrlikBundle\Entity\Teams $teams
     *
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Teams", inversedBy="teamTournament" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    protected $team;


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
     * Set tournament
     *
     * @param integer $tournamentId
     * @return TournamentTeams
     */
    public function setTournament($tournamentId)
    {
        $this->tournament = $tournamentId;
    
        return $this;
    }

    /**
     * Get tournament
     *
     * @return integer 
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set team
     *
     * @param integer $teamId
     * @return TournamentTeams
     */
    public function setTeam($teamId)
    {
        $this->team = $teamId;
    
        return $this;
    }

    /**
     * Get teamId
     *
     * @return integer 
     */
    public function getTeamId()
    {
        return $this->team;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tournament = new \Doctrine\Common\Collections\ArrayCollection();
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add tournament
     *
     * @param \Skoki\OrlikBundle\Entity\Tournaments $tournamentId
     * @return TournamentTeams
     */
    public function addTournament(\Skoki\OrlikBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournament[] = $tournamentId;
    
        return $this;
    }

    /**
     * Remove tournamentId
     *
     * @param \Skoki\OrlikBundle\Entity\Tournaments $tournamentId
     */
    public function removeTournament(\Skoki\OrlikBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournament->removeElement($tournamentId);
    }

    /**
     * Add teamId
     *
     * @param \Skoki\OrlikBundle\Entity\Teams $teamId
     * @return TournamentTeams
     */
    public function addTeam(\Skoki\OrlikBundle\Entity\Teams $teamId)
    {
        $this->team[] = $teamId;
    
        return $this;
    }

    /**
     * Remove teamId
     *
     * @param \Skoki\OrlikBundle\Entity\Teams $teamId
     */
    public function removeTeam(\Skoki\OrlikBundle\Entity\Teams $teamId)
    {
        $this->team->removeElement($teamId);
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
