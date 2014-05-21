<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Skoki\OrlikBundle\Entity\TournamentsTeams;


/**
 * Teams
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Repository\TeamsRepository")
 */
class Teams
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="TournamentTeams", mappedBy="team_id")
     * @ORM\OneToMany(targetEntity="TeamMatches", mappedBy="team_id")
     * @ORM\OneToOne(targetEntity="StatTable", mappedBy="team_id")
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
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var integer
     *
     * @ORM\Column(name="capitan", type="integer", nullable=true)
     */
    private $capitan;

    /**
     * @var ArrayCollection<TournamentTeams> $teamTournament
     *
     * @ORM\OneToMany(targetEntity="Skoki\OrlikBundle\Entity\TournamentTeams", mappedBy="team_id", cascade={"all"}, orphanRemoval=true)
     */
    private $teamTournament;

    /**
     * @var ArrayCollection $players
     * @ORM\OneToMany(targetEntity="Players", mappedBy="team")
     */
    protected $players;

    /**
     * @var ArrayCollection<teamMatches> $teamMatches
     *
     * @ORM\OneToMany(targetEntity="Skoki\OrlikBundle\Entity\TeamMatches", mappedBy="team")
     */
    private $teamMatches;
//    /**
//    /**
//     * @var ArrayCollection<teamMatches> $awayMatches
//     *
//     * @ORM\OneToMany(targetEntity="Skoki\OrlikBundle\Entity\teamMatches", mappedBy="away")
//     */
//    private $awayMatches;


    /**
     * Set id
     *
     * @param integer $id
     * @return Teams
     */
    public function setId($id = null)
    {
        if ($id != null) {
            $this->id = $id;
        }
        return $this;
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
     * Set name
     *
     * @param string $name
     * @return Teams
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
     * Set email
     *
     * @param string $email
     * @return Teams
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Teams
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Teams
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return Teams
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    
        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set capitan
     *
     * @param integer $capitan
     * @return Teams
     */
    public function setCapitan($capitan)
    {
        $this->capitan = $capitan;
    
        return $this;
    }

    /**
     * Get capitan
     *
     * @return integer 
     */
    public function getCapitan()
    {
        return $this->capitan;
    }

    /**
     * Add tournaments
     *
     * @param \Skoki\OrlikBundle\Entity\TournamentTeams $tournaments
     * @return Teams
     */
    public function addTournament(\Skoki\OrlikBundle\Entity\TournamentTeams $tournaments)
    {
        $this->tournaments[] = $tournaments;
    
        return $this;
    }

    /**
     * Remove tournaments
     *
     * @param \Skoki\OrlikBundle\Entity\TournamentTeams $tournaments
     */
    public function removeTournament(\Skoki\OrlikBundle\Entity\TournamentTeams $tournaments)
    {
        $this->tournaments->removeElement($tournaments);
    }

    /**
     * Get tournaments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTournaments()
    {
        return $this->tournaments;
    }

    /**
     * Set tournaments
     *
     * @param \Skoki\OrlikBundle\Entity\TournamentTeams $tournaments
     * @return Teams
     */
    public function setTournaments(\Skoki\OrlikBundle\Entity\TournamentTeams $tournaments = null)
    {
        $this->tournaments = $tournaments;
    
        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tournaments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
        $this->teamMatches = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Add teamTournament
     *
     * @param \Skoki\OrlikBundle\Entity\TournamentTeams $teamTournament
     * @return Teams
     */
    public function addTeamTournament(\Skoki\OrlikBundle\Entity\TournamentTeams $teamTournament)
    {
        $this->teamTournament[] = $teamTournament;
    
        return $this;
    }

    /**
     * Remove teamTournament
     *
     * @param \Skoki\OrlikBundle\Entity\TournamentTeams $teamTournament
     */
    public function removeTeamTournament(\Skoki\OrlikBundle\Entity\TournamentTeams $teamTournament)
    {
        $this->teamTournament->removeElement($teamTournament);
    }

    /**
     * Get teamTournament
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeamTournament()
    {
        return $this->teamTournament;
    }

    /**
     * Add players
     *
     * @param \Skoki\OrlikBundle\Entity\Players $players
     * @return Teams
     */
    public function addPlayer(\Skoki\OrlikBundle\Entity\Players $players)
    {
        $this->players[] = $players;
    
        return $this;
    }

    /**
     * Remove players
     *
     * @param \Skoki\OrlikBundle\Entity\Players $players
     */
    public function removePlayer(\Skoki\OrlikBundle\Entity\Players $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }

//    /**
//     * Add teamMatches
//     *
//     * @param \Skoki\OrlikBundle\Entity\teamMatches $teamMatches
//     * @return Teams
//     */
//    public function addTeamMatche(\Skoki\OrlikBundle\Entity\teamMatches $teamMatches)
//    {
//        $this->teamMatches[] = $teamMatches;
//
//        return $this;
//    }
//
//    /**
//     * Remove teamMatches
//     *
//     * @param \Skoki\OrlikBundle\Entity\teamMatches $teamMatches
//     */
//    public function removeTeamMatche(\Skoki\OrlikBundle\Entity\teamMatches $teamMatches)
//    {
//        $this->teamMatches->removeElement($teamMatches);
//    }
//
//    /**
//     * Get teamMatches
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getTeamMatches()
//    {
//        return $this->teamMatches;
//    }

    /**
     * Add homeMatch
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $homeMatches
     * @return Teams
     */
    public function addHomeMatches(\Skoki\OrlikBundle\Entity\teamMatches $homeMatches)
    {
        $this->homeMatches[] = $homeMatches;
    
        return $this;
    }

    /**
     * Remove homeMatches
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $homeMatches
     */
    public function removeHomeMatch(\Skoki\OrlikBundle\Entity\teamMatches $homeMatches)
    {
        $this->homeMatches->removeElement($homeMatches);
    }

    /**
     * Get homeMatches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomeMatches()
    {
        return $this->homeMatches;
    }

    /**
     * Add awayMatches
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $awayMatches
     * @return Teams
     */
    public function addAwayMatches(\Skoki\OrlikBundle\Entity\teamMatches $awayMatches)
    {
        $this->awayMatches[] = $awayMatches;
    
        return $this;
    }

    /**
     * Remove awayMatches
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $awayMatches
     */
    public function removeAwayMatches(\Skoki\OrlikBundle\Entity\teamMatches $awayMatches)
    {
        $this->awayMatches->removeElement($awayMatches);
    }

    /**
     * Get awayMatches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAwayMatches()
    {
        return $this->awayMatches;
    }

    /**
     * Add teamMatches
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $teamMatches
     * @return Teams
     */
    public function addTeamMatche(\Skoki\OrlikBundle\Entity\teamMatches $teamMatches)
    {
        $this->teamMatches[] = $teamMatches;
    
        return $this;
    }

    /**
     * Remove teamMatches
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $teamMatches
     */
    public function removeTeamMatche(\Skoki\OrlikBundle\Entity\teamMatches $teamMatches)
    {
        $this->teamMatches->removeElement($teamMatches);
    }

    /**
     * Get teamMatches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeamMatches()
    {
        return $this->teamMatches;
    }

    /**
     * Add teamMatches
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $teamMatches
     * @return Teams
     */
    public function addTeamMatch(\Skoki\OrlikBundle\Entity\teamMatches $teamMatches)
    {
        $this->teamMatches[] = $teamMatches;

        return $this;
    }

    /**
     * Remove teamMatches
     *
     * @param \Skoki\OrlikBundle\Entity\teamMatches $teamMatches
     */
    public function removeTeamMatch(\Skoki\OrlikBundle\Entity\teamMatches $teamMatches)
    {
        $this->teamMatches->removeElement($teamMatches);
    }
}
