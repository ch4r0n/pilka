<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Skoki\OrlikBundle\Entity\Tournaments;
use Skoki\OrlikBundle\Entity\Teams;
/**
 *
 * Skoki\OrlikBundle\Entity\PlayerCards
 *
 * PlayerCards
 *
 * @ORM\Table(name="player_cards")
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Repository\PlayerCardsRepository")
 */
class PlayerCards
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
     * @var \Skoki\OrlikBundle\Entity\Players $players
     *
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Players", inversedBy="playerCards" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    protected $player;


    /**
     * @var \Skoki\OrlikBundle\Entity\Matches $match
     *
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Matches", inversedBy="matchCards" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     */
    protected $match;

    /**
     * @var string
     *
     * @ORM\Column(name="card_type", type="string", nullable=true)
     */
    protected $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    protected $number;

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
     * Set type
     *
     * @param string $type
     * @return PlayerCards
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return PlayerCards
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set player
     *
     * @param \Skoki\OrlikBundle\Entity\Players $player
     * @return PlayerCards
     */
    public function setPlayer(\Skoki\OrlikBundle\Entity\Players $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Skoki\OrlikBundle\Entity\Players 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set match
     *
     * @param \Skoki\OrlikBundle\Entity\Matches $match
     * @return PlayerCards
     */
    public function setMatch(\Skoki\OrlikBundle\Entity\Matches $match = null)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \Skoki\OrlikBundle\Entity\Matches 
     */
    public function getMatch()
    {
        return $this->match;
    }
}
