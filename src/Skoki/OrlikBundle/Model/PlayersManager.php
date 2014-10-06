<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 10.07.14
 * Time: 02:57
 */

namespace Skoki\OrlikBundle\Model;

use Doctrine\ORM\EntityManager;
use Skoki\OrlikBundle\Entity\Teams;
use Skoki\OrlikBundle\Entity\Players;
use Skoki\OrlikBundle\Entity\Matches;

class PlayersManager {

    protected $playerRepo;
    protected $teamRepo;

    protected $teamsNameArray;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
        $this->playerRepo = $entityManager->getRepository('SkokiOrlikBundle:Players');
        $this->teamRepo = $entityManager->getRepository('SkokiOrlikBundle:Teams');
    }

    public function createManyPlayers(Teams $team, $newPlayersList)
    {
        foreach($newPlayersList as $man) {
            if (!$this->checkPlayerExist($man)) {
                $newPlayer = new Players();
                $newPlayer->setFirstname($man['firstname']);
                $newPlayer->setLastname($man['lastname']);
                $newPlayer->setTeam($team);
                $this->em->persist($newPlayer);
            }
        }
        if ($this->em->flush()) {
            return true;
        } else
            return false;

    }

    public function checkPlayerExist($playerInfo) {
        $result = $this->playerRepo->findBy(array(
                'firstname' => $playerInfo['firstname'],
                'lastname' => $playerInfo['lastname']
        ));
        if ($result)
            return true;
        else
            return false;
    }

    public function addPlayerGolInMatch (Players $player, Matches $match)
    {

    }

} 