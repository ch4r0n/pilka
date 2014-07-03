<?php

namespace Cup\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * cup_group
 *
 * @ORM\Table(name="cup_group")
 * @ORM\Entity(repositoryClass="Cup\HomeBundle\Repository\CupGroupRepository")
 */
class CupGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var ArrayCollection<CupGroupTeam> $groupTeams
     *
     * @ORM\OneToMany(targetEntity="Cup\HomeBundle\Entity\CupGroupTeam", mappedBy="cup_group", cascade={"all"}, orphanRemoval=true)
     */
    private $groupTeams;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groupTeams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return cup_group
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
     * Set teams
     *
     * @param string $teams
     * @return cup_group
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;

        return $this;
    }

    /**
     * Get teams
     *
     * @return string 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}
