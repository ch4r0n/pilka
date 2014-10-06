<?php

namespace Skoki\OrlikBundle\Model;

use Skoki\OrlikBundle\Repository\Repository;

class TournamentManager
{
    protected $roundRepo;

    protected $tournamentRepo;

    protected $tournament;

    protected $rounds;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
        $this->roundRepo = $entityManager->getRepository(Repository::ROUNDS);
        $this->tournamentRepo = $entityManager->getRepository(Repository::TOURNAMENTS);
    }

    public function setRounds($tournamentId)
    {
        $this->tournament = $this->tournamentRepo->findOneById($tournamentId);
        if ($this->tournament) {
            $this->rounds = $this->roundRepo->findBy(array('tournament' => $this->tournament));
        }
    }

    public function getRounds()
    {
        return $this->rounds;
    }


} 