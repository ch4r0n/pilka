<?php

namespace Orlik\HomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Orlik\HomepageBundle\Entity\TournamentsTeams;
use Orlik\HomepageBundle\Entity\TeamMatches;

/**
 * Teams
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Orlik\HomepageBundle\Repository\TeamsRepository")
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
     * @ORM\OneToMany(targetEntity="Orlik\HomepageBundle\Entity\TournamentTeams", mappedBy="team_id", cascade={"all"}, orphanRemoval=true)
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
     * @ORM\OneToMany(targetEntity="Orlik\HomepageBundle\Entity\teamMatches", mappedBy="team")
     */
    private $teamMatches;
//    /**
//    /**
//     * @var ArrayCollection<teamMatches> $awayMatches
//     *
//     * @ORM\OneToMany(targetEntity="Orlik\HomepageBundle\Entity\teamMatches", mappedBy="away")
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
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $tournaments
     * @return Teams
     */
    public function addTournament(\Orlik\HomepageBundle\Entity\TournamentTeams $tournaments)
    {
        $this->tournaments[] = $tournaments;
    
        return $this;
    }

    /**
     * Remove tournaments
     *
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $tournaments
     */
    public function removeTournament(\Orlik\HomepageBundle\Entity\TournamentTeams $tournaments)
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
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $tournaments
     * @return Teams
     */
    public function setTournaments(\Orlik\HomepageBundle\Entity\TournamentTeams $tournaments = null)
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
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $teamTournament
     * @return Teams
     */
    public function addTeamTournament(\Orlik\HomepageBundle\Entity\TournamentTeams $teamTournament)
    {
        $this->teamTournament[] = $teamTournament;
    
        return $this;
    }

    /**
     * Remove teamTournament
     *
     * @param \Orlik\HomepageBundle\Entity\TournamentTeams $teamTournament
     */
    public function removeTeamTournament(\Orlik\HomepageBundle\Entity\TournamentTeams $teamTournament)
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
     * @param \Orlik\HomepageBundle\Entity\Players $players
     * @return Teams
     */
    public function addPlayer(\Orlik\HomepageBundle\Entity\Players $players)
    {
        $this->players[] = $players;
    
        return $this;
    }

    /**
     * Remove players
     *
     * @param \Orlik\HomepageBundle\Entity\Players $players
     */
    public function removePlayer(\Orlik\HomepageBundle\Entity\Players $players)
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
//     * @param \Orlik\HomepageBundle\Entity\teamMatches $teamMatches
//     * @return Teams
//     */
//    public function addTeamMatche(\Orlik\HomepageBundle\Entity\teamMatches $teamMatches)
//    {
//        $this->teamMatches[] = $teamMatches;
//
//        return $this;
//    }
//
//    /**
//     * Remove teamMatches
//     *
//     * @param \Orlik\HomepageBundle\Entity\teamMatches $teamMatches
//     */
//    public function removeTeamMatche(\Orlik\HomepageBundle\Entity\teamMatches $teamMatches)
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
     * @param \Orlik\HomepageBundle\Entity\teamMatches $homeMatches
     * @return Teams
     */
    public function addHomeMatches(\Orlik\HomepageBundle\Entity\teamMatches $homeMatches)
    {
        $this->homeMatches[] = $homeMatches;
    
        return $this;
    }

    /**
     * Remove homeMatches
     *
     * @param \Orlik\HomepageBundle\Entity\teamMatches $homeMatches
     */
    public function removeHomeMatch(\Orlik\HomepageBundle\Entity\teamMatches $homeMatches)
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
     * @param \Orlik\HomepageBundle\Entity\teamMatches $awayMatches
     * @return Teams
     */
    public function addAwayMatches(\Orlik\HomepageBundle\Entity\teamMatches $awayMatches)
    {
        $this->awayMatches[] = $awayMatches;
    
        return $this;
    }

    /**
     * Remove awayMatches
     *
     * @param \Orlik\HomepageBundle\Entity\teamMatches $awayMatches
     */
    public function removeAwayMatches(\Orlik\HomepageBundle\Entity\teamMatches $awayMatches)
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
     * @param \Orlik\HomepageBundle\Entity\teamMatches $teamMatches
     * @return Teams
     */
    public function addTeamMatche(\Orlik\HomepageBundle\Entity\teamMatches $teamMatches)
    {
        $this->teamMatches[] = $teamMatches;
    
        return $this;
    }

    /**
     * Remove teamMatches
     *
     * @param \Orlik\HomepageBundle\Entity\teamMatches $teamMatches
     */
    public function removeTeamMatche(\Orlik\HomepageBundle\Entity\teamMatches $teamMatches)
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
}