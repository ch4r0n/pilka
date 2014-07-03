<?php

namespace Skoki\OrlikBundle\Repository;

use Skoki\OrlikBundle\Entity\Teams;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class StatTableRepository extends EntityRepository
{
    public function getTournamentStats($tournament = null)
    {
        $em = $this->getEntityManager();
        $gb = $em->createQueryBuilder();
        $gb->select('s')
            ->from('SkokiOrlikBundle:StatTable', 's')
            ->orderBy('s.pkt', 'DESC')
            ->addOrderBy('s.rb', 'DESC');
        if ($tournament !== null) {
            $gb->where('s.tournament = :tournament');
            $gb->setParameters(array('tournament' => $tournament));
        }
        $query = $gb->getQuery();
        $teams = $query->getResult();

        return $teams;
    }

} 