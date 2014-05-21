<?php

namespace Skoki\OrlikBundle\Repository;

use Skoki\OrlikBundle\Entity\Teams;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;

class TeamsRepository extends EntityRepository
{
    public function getListForForm()
    {
        $em = $this->getEntityManager();
        $gb = $em->createQueryBuilder();
        $gb->select('t.id, t.name')
            ->from('SkokiOrlikBundle:Teams', 't')
            ->orderBy('t.name', 'ASC');
        $query = $gb->getQuery();
        $teams = $query->getResult();
        $result = array();

//        foreach ($teams as $t) {
//            $result[$t['id']] = $t['name'];
//        }

        return $teams;
    }
} 