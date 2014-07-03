<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 17.06.14
 * Time: 00:48
 */

namespace Cup\HomeBundle\DataProvider;

use Doctrine\ORM\EntityManager;
use Cup\HomeBundle\Repository\Repository;
use Cup\HomeBundle\Entity\CupMatch;
use Cup\HomeBundle\Entity\UserBeats;
use Skoki\UserBundle\Entity\User;


class MyBeatProvider
{
    protected $em;
    protected $matchRepo;
    protected $userRepo;
    protected $userBeatRepo;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->matchRepo = $entityManager->getRepository(Repository::CUP_MATCH);
        $this->userRepo = $entityManager->getRepository(Repository::USER_BEATS);
        $this->userBeatRepo = $entityManager->getRepository(Repository::USER_BEATS);
    }

    public function getUserBeats(User $user)
    {
        $beats = $this->userBeatRepo->findBy(array(
            'cupUser' => $user->getId()
        ));
        $return = array();
        if ($beats) {
            foreach ($beats as $bb) {
                $return[$bb->getCupMatch()->getId()] = $bb;
            }
        }

        return $return;
    }
} 