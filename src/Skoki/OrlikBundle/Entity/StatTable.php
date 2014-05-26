<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Skoki\OrlikBundle\Entity\Teams;

/**
 * StatTable
 *
 * @ORM\Table(name="stattable")
 * @ORM\Entity(repositoryClass="Skoki\OrlikBundle\Entity\StatTableRepository")
 */
class StatTable
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
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Teams")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $teamId;

    /**
     * @var string
     *
     * @ORM\Column(name="team_name", type="string", length=255, nullable=true)
     */
    private $teamName;

    /**
     * Rozegrane sporkania
     *
     * @var integer
     *
     * @ORM\Column(name="rs", type="integer", nullable=true)
     */
    private $rs;

    /**
     * Zwyciestwa
     *
     * @var integer
     *
     * @ORM\Column(name="z", type="integer", nullable=true)
     */
    private $z;

    /**
     * Remisy
     *
     * @var integer
     *
     * @ORM\Column(name="r", type="integer", nullable=true)
     */
    private $r;

    /**
     * Porazki
     *
     * @var integer
     *
     * @ORM\Column(name="p", type="integer", nullable=true)
     */
    private $p;

    /**
     * Bramki Zdobyte
     *
     * @var integer
     *
     * @ORM\Column(name="bz", type="integer", nullable=true)
     */
    private $bz;

    /**
     * Bramki Stracone
     *
     * @var integer
     *
     * @ORM\Column(name="bs", type="integer", nullable=true)
     */
    private $bs;

    /**
     * Roznica strzelonych do straconych
     *
     * @var integer
     *
     * @ORM\Column(name="rb", type="integer", nullable=true)
     */
    private $rb;

    /**
     * Punkty
     *
     * @var integer
     *
     * @ORM\Column(name="pkt", type="integer", nullable=true)
     */
    private $pkt;

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->bs = 0;
        $this->bz = 0;
        $this->z = 0;
        $this->r = 0;
        $this->p = 0;
        $this->rb = 0;
        $this->rs = 0;
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
     * Set teamId
     *
     * @param integer $teamId
     * @return StatTable
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;

        return $this;
    }

    /**
     * Get teamId
     *
     * @return integer 
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * Set teamName
     *
     * @param string $teamName
     * @return StatTable
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;

        return $this;
    }

    /**
     * Get teamName
     *
     * @return string 
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set rs
     *
     * @param integer $rs
     * @return StatTable
     */
    public function setRs($rs)
    {
        $this->rs = $rs;

        return $this;
    }

    /**
     * Get rs
     *
     * @return integer 
     */
    public function getRs()
    {
        return $this->rs;
    }

    /**
     * Set z
     *
     * @param integer $z
     * @return StatTable
     */
    public function setZ($z)
    {
        $this->z = $z;

        return $this;
    }

    /**
     * Get z
     *
     * @return integer 
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * Set r
     *
     * @param integer $r
     * @return StatTable
     */
    public function setR($r)
    {
        $this->r = $r;

        return $this;
    }

    /**
     * Get r
     *
     * @return integer 
     */
    public function getR()
    {
        return $this->r;
    }

    /**
     * Set p
     *
     * @param integer $p
     * @return StatTable
     */
    public function setP($p)
    {
        $this->p = $p;

        return $this;
    }

    /**
     * Get p
     *
     * @return integer 
     */
    public function getP()
    {
        return $this->p;
    }

    /**
     * Set bz
     *
     * @param integer $bz
     * @return StatTable
     */
    public function setBz($bz)
    {
        $this->bz = $bz;

        return $this;
    }

    /**
     * Get bz
     *
     * @return integer 
     */
    public function getBz()
    {
        return $this->bz;
    }

    /**
     * Set bs
     *
     * @param integer $bs
     * @return StatTable
     */
    public function setBs($bs)
    {
        $this->bs = $bs;

        return $this;
    }

    /**
     * Get bs
     *
     * @return integer 
     */
    public function getBs()
    {
        return $this->bs;
    }

    /**
     * Set rb
     *
     * @param integer $rb
     * @return StatTable
     */
    public function setRb($rb)
    {
        $this->rb = $rb;

        return $this;
    }

    /**
     * Get rb
     *
     * @return integer 
     */
    public function getRb()
    {
        return $this->rb;
    }

    /**
     * Set pkt
     *
     * @param integer $pkt
     * @return StatTable
     */
    public function setPkt($pkt)
    {
        $this->pkt = $pkt;

        return $this;
    }

    /**
     * Get pkt
     *
     * @return integer 
     */
    public function getPkt()
    {
        return $this->pkt;
    }
}
