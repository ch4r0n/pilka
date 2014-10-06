<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Skoki\OrlikBundle\Entity\Tournaments;
use Skoki\OrlikBundle\Entity\Teams;
/**
 *
 * Skoki\OrlikBundle\Entity\PlayerGoals
 *
 * PlayerGoals
 *
 * @ORM\Table(name="player_goals")
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Repository\PlayerGoalsRepository")
 */

class PlayerGoals
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
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Players", inversedBy="playerGoals" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    protected $player;


    /**
     * @var \Skoki\OrlikBundle\Entity\Matches $match
     *
     * @ORM\ManyToOne(targetEntity="\Skoki\OrlikBundle\Entity\Matches", inversedBy="matchGoals" ,cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     */
    protected $match;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    protected $score;

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
     * Set score
     *
     * @param integer $score
     * @return PlayerGoals
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set player
     *
     * @param \Skoki\OrlikBundle\Entity\Players $player
     * @return PlayerGoals
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
     * @return PlayerGoals
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
