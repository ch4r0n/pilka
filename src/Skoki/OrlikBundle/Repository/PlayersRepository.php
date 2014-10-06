<?php

namespace Skoki\OrlikBundle\Repository;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;
use Skoki\OrlikBundle\Entity\Players;
use Skoki\OrlikBundle\Entity\Teams;

class PlayersRepository  extends EntityRepository
{
        public function getTeamPlayers(Teams $team) {
            $em = $this->getEntityManager();
            $gb = $em->createQueryBuilder();
            $gb->select('p')
                ->from('SkokiOrlikBundle:Players', 'p')
                ->orderBy('p.numer', 'ASC');
            $gb->where('p.team = :team');
            $gb->setParameters(array('team' => $team));
            $query = $gb->getQuery();
            $teams = $query->getResult();
            $result = array();

            if (is_array($teams)) {
                foreach ($teams as $t) {
                    $result[$t->getId()] = $t;
                }
            }

            return $result;
        }
} 