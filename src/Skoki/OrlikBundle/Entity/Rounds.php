<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rounds
 *
 * @ORM\Table(name="rounds")
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Repository\RoundsRepository")
 */
class Rounds
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Tournaments", mappedBy="rounds")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Tournaments", inversedBy="rounds")
     * @ORM\JoinColumn(name="tournament", referencedColumnName="id")
     */
    private $tournament;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var ArrayCollection $roundMatches
     * @ORM\OneToMany(targetEntity="Matches", mappedBy="rounds")
     */
    protected $roundMatches;

    /**
     * @var integer
     *
     * @ORM\Column(name="torder", type="integer")
     */
    private $torder;

    public function __toString()
    {
        return 'Kolejka ' . $this->torder;
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
     * Set tournamentId
     *
     * @param integer $tournamentId
     * @return Rounds
     */
    public function setTournamentId($tournamentId)
    {
        $this->tournamentId = $tournamentId;
    
        return $this;
    }

    /**
     * Get tournamentId
     *
     * @return integer 
     */
    public function getTournamentId()
    {
        return $this->tournamentId;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Rounds
     */
    public function setDate($date)
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
     * Set comment
     *
     * @param string $comment
     * @return Rounds
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Rounds
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
     * Set tournament
     *
     * @param \Skoki\OrlikBundle\Entity\Tournaments $tournament
     * @return Rounds
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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roundMatches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add roundMatches
     *
     * @param \Skoki\OrlikBundle\Entity\Matches $roundMatches
     * @return Rounds
     */
    public function addRoundMatche(\Skoki\OrlikBundle\Entity\Matches $roundMatches)
    {
        $this->roundMatches[] = $roundMatches;
    
        return $this;
    }

    /**
     * Remove roundMatches
     *
     * @param \Skoki\OrlikBundle\Entity\Matches $roundMatches
     */
    public function removeRoundMatche(\Skoki\OrlikBundle\Entity\Matches $roundMatches)
    {
        $this->roundMatches->removeElement($roundMatches);
    }

    /**
     * Get roundMatches
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoundMatches()
    {
        return $this->roundMatches;
    }

    /**
     * Set torder
     *
     * @param integer $torder
     * @return Rounds
     */
    public function setOrder($order)
    {
        $this->torder = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->torder;
    }

    /**
     * Set torder
     *
     * @param integer $torder
     * @return Rounds
     */
    public function setTorder($torder)
    {
        $this->torder = $torder;
    
        return $this;
    }

    /**
     * Get torder
     *
     * @return integer 
     */
    public function getTorder()
    {
        return $this->torder;
    }

    /**
     * Add roundMatches
     *
     * @param \Skoki\OrlikBundle\Entity\Matches $roundMatches
     * @return Rounds
     */
    public function addRoundMatch(\Skoki\OrlikBundle\Entity\Matches $roundMatches)
    {
        $this->roundMatches[] = $roundMatches;

        return $this;
    }

    /**
     * Remove roundMatches
     *
     * @param \Skoki\OrlikBundle\Entity\Matches $roundMatches
     */
    public function removeRoundMatch(\Skoki\OrlikBundle\Entity\Matches $roundMatches)
    {
        $this->roundMatches->removeElement($roundMatches);
    }
}
