<?php

namespace Cup\HomeBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CupGroupRepository extends EntityRepository
{
    public function getListForForm()
    {
        $em = $this->getEntityManager();
        $gb = $em->createQueryBuilder();
        $gb->select('t.id, t.name')
            ->from('CupHomeBundle:CupGroup', 't')
            ->orderBy('t.name', 'ASC');
        $query = $gb->getQuery();
        $teams = $query->getResult();
        $result = array();

        foreach ($teams as $t) {
            $result[$t['id']] = $t['name'];
        }

        return $result;
    }
} 