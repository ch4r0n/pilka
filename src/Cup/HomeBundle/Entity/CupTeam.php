<?php

namespace Cup\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cup_team
 *
 * @ORM\Table(name="cup_team")
 * @ORM\Entity(repositoryClass="Cup\HomeBundle\Repository\CupTeamRepository")
 */
class CupTeam
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
     * @var string
     *
     * @ORM\Column(name="logo", type="text", nullable=true)
     */
    private $logo;

    /**
     * @var integer
     *
     * @ORM\Column(name="cup", type="integer", nullable=true)
     */
    private $cup;

    /**
     * @var integer
     *
     * @ORM\Column(name="cup_group", type="integer", nullable=true)
     */
    private $grupa;
    /**
     * @var ArrayCollection<CupGroupTeam> $cupGroup
     *
     * @ORM\OneToMany(targetEntity="Cup\HomeBundle\Entity\CupGroupTeam", mappedBy="cup_team", cascade={"all"}, orphanRemoval=true)
     */
    private $cupGroup;

    /**
     * @var ArrayCollection<CupTeamMatch> $cupMatch
     * @ORM\OneToMany(targetEntity="Cup\HomeBundle\Entity\CupTeamMatch", mappedBy="cup_team", cascade={"all"}, orphanRemoval=true)
     */
    private $cupMatch;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cupGroup = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cupMatch = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return cup_team
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
     * Set logo
     *
     * @param string $logo
     * @return cup_team
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set cup
     *
     * @param integer $cup
     * @return cup_team
     */
    public function setCup($cup)
    {
        $this->cup = $cup;

        return $this;
    }

    /**
     * Get cup
     *
     * @return integer 
     */
    public function getCup()
    {
        return $this->cup;
    }

    /**
     * Set grupa
     *
     * @param integer $grupa
     * @return cup_team
     */
    public function setGrupa($grupa)
    {
        $this->grupa = $grupa;

        return $this;
    }

    /**
     * Get Grupa
     *
     * @return integer
     */
    public function getGrupa()
    {
        return $this->grupa;
    }

    /**
     * Set cupGroup
     *
     * @param string $cupGroup
     * @return cup_team
     */
    public function setCupGroup($cupGroup)
    {
        $this->cupGroup = $cupGroup;

        return $this;
    }

    /**
     * Get cupGroup
     *
     * @return string 
     */
    public function getCupGroup()
    {
        return $this->cupGroup;
    }
    /*

    INSERT INTO `pilka`.`cup_team` (`id`, `name`, `logo`, `cup`) VALUES (NULL, 'Brazylia', NULL, NULL), (NULL, 'Chorwacja', NULL, NULL);
    INSERT INTO `pilka`.`cup_group` (`id`, `name`) VALUES (NULL, 'A'), (NULL, 'B'), (NULL, 'C'), (NULL, 'D'), (NULL, 'E'), (NULL, 'F'), (NULL, 'G'), (NULL, 'H');

    INSERT INTO `pilka`.`cup_group_team` (`id`, `cup_group`, `cup_team`, `place`) VALUES (NULL, '1', '1', NULL), (NULL, '1', '2', NULL);



CREATE TABLE cup_team_match (id INT AUTO_INCREMENT NOT NULL, cup_team INT DEFAULT NULL, cup_match INT DEFAULT NULL, INDEX IDX_17075087D1D3AB65 (cup_team), INDEX IDX_17075087CA9E6E2A (cup_match), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE cup_team_match ADD CONSTRAINT FK_17075087D1D3AB65 FOREIGN KEY (cup_team) REFERENCES cup_team (id);
ALTER TABLE cup_team_match ADD CONSTRAINT FK_17075087CA9E6E2A FOREIGN KEY (cup_match) REFERENCES cup_match (id);


    INSERT INTO `pilka`.`cup_match` (`id`, `cup_group`, `match_date`, `team_home`, `team_away`, `home_score`, `away_score`, `result`) VALUES (NULL, '1', '2014-06-12 22:00:00', '1', '2', '3', '1', '1');

    INSERT INTO `pilka`.`cup_team_match` (`id`, `cup_team`, `cup_match`) VALUES (NULL, '1', '1'), (NULL, '2', '1');


    CREATE TABLE beat (id INT AUTO_INCREMENT NOT NULL, beat VARCHAR(100) NOT NULL, win TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE UserBeats (id INT AUTO_INCREMENT NOT NULL, cup_beat INT DEFAULT NULL, cup_match INT DEFAULT NULL, win TINYINT(1) NOT NULL, cupUser INT DEFAULT NULL, INDEX IDX_86F6781789EA53D0 (cupUser), INDEX IDX_86F67817C0CA0BE6 (cup_beat), INDEX IDX_86F67817CA9E6E2A (cup_match), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE UserBeats ADD CONSTRAINT FK_86F6781789EA53D0 FOREIGN KEY (cupUser) REFERENCES fos_user (id);
ALTER TABLE UserBeats ADD CONSTRAINT FK_86F67817C0CA0BE6 FOREIGN KEY (cup_beat) REFERENCES beat (id);
ALTER TABLE UserBeats ADD CONSTRAINT FK_86F67817CA9E6E2A FOREIGN KEY (cup_match) REFERENCES cup_match (id);

    ALTER TABLE userbeats DROP FOREIGN KEY FK_86F67817C0CA0BE6;
DROP INDEX IDX_86F67817C0CA0BE6 ON userbeats;
ALTER TABLE userbeats CHANGE cup_beat cup_beat INT NOT NULL;
    ALTER TABLE userbeats CHANGE win win TINYINT(1) DEFAULT NULL;

    ALTER TABLE userbeats DROP FOREIGN KEY FK_86F6781789EA53D0;
DROP INDEX IDX_86F6781789EA53D0 ON userbeats;
ALTER TABLE userbeats CHANGE cupuser cup_user INT DEFAULT NULL;
ALTER TABLE userbeats ADD CONSTRAINT FK_86F6781798A0DB33 FOREIGN KEY (cup_user) REFERENCES fos_user (id);
CREATE INDEX IDX_86F6781798A0DB33 ON userbeats (cup_user);

    ALTER TABLE userbeats DROP FOREIGN KEY FK_86F6781798A0DB33;
DROP INDEX IDX_86F6781798A0DB33 ON userbeats;
ALTER TABLE userbeats CHANGE cup_user cup_user INT NOT NULL;

    ALTER TABLE cup_team ADD cup_group INT DEFAULT NULL;

     */
}
