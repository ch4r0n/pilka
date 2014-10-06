<?php

namespace Cup\HomeBundle\DataProvider;

use Doctrine\ORM\EntityManager;
use Cup\HomeBundle\Repository\Repository;
use Cup\HomeBundle\Entity\CupMatch;


class CupMatchProvider
{
    protected $em;
    protected $matchRepo;
    protected $teamRepo;
    protected $groupRepo;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->matchRepo = $entityManager->getRepository(Repository::CUP_MATCH);
        $this->teamRepo = $entityManager->getRepository(Repository::CUP_TEAM);
        $this->groupRepo = $entityManager->getRepository(Repository::CUP_GROUP);
    }

    public function getMatchDetails(CupMatch $match)
    {
        $home = $this->teamRepo->findOneById($match->getTeamHome());
        $away = $this->teamRepo->findOneById($match->getTeamAway());
        $group = $this->groupRepo->findOneById($match->getCupGroup());
        $match->setTeamHome($home);
        $match->setTeamAway($away);
        $match->setCupGroup($group);

        return $match;
    }
} 