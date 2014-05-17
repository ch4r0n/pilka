<?php

namespace Orlik\HomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Orlik\HomepageBundle\Entity\Tournaments;
use Orlik\HomepageBundle\Entity\Teams;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *
 * Orlik\HomepageBundle\Entity\TournamentTeams
 *
 * TournamentTeams
 *
 * @ORM\Table(name="tournament_teams")
 * @ORM\Entity(repositoryClass="Orlik\HomepageBundle\Repository\TournamentTeamsRepository")
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
     * @var \Orlik\HomepageBundle\Entity\Tournaments $tournament
     *
     * @ORM\ManyToOne(targetEntity="\Orlik\HomepageBundle\Entity\Tournaments", inversedBy="tournamentTeams" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
     */
    protected $tournament;


    /**
     * @var \Orlik\HomepageBundle\Entity\Teams $teams
     *
     * @ORM\ManyToOne(targetEntity="\Orlik\HomepageBundle\Entity\Teams", inversedBy="teamTournament" ,cascade={"persist"}, fetch="EAGER")
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
     * @param \Orlik\HomepageBundle\Entity\Tournaments $tournamentId
     * @return TournamentTeams
     */
    public function addTournament(\Orlik\HomepageBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournament[] = $tournamentId;
    
        return $this;
    }

    /**
     * Remove tournamentId
     *
     * @param \Orlik\HomepageBundle\Entity\Tournaments $tournamentId
     */
    public function removeTournament(\Orlik\HomepageBundle\Entity\Tournaments $tournamentId)
    {
        $this->tournament->removeElement($tournamentId);
    }

    /**
     * Add teamId
     *
     * @param \Orlik\HomepageBundle\Entity\Teams $teamId
     * @return TournamentTeams
     */
    public function addTeam(\Orlik\HomepageBundle\Entity\Teams $teamId)
    {
        $this->team[] = $teamId;
    
        return $this;
    }

    /**
     * Remove teamId
     *
     * @param \Orlik\HomepageBundle\Entity\Teams $teamId
     */
    public function removeTeam(\Orlik\HomepageBundle\Entity\Teams $teamId)
    {
        $this->team->removeElement($teamId);
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