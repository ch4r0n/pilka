<?php

namespace Skoki\OrlikBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skoki\OrlikBundle\Entity\Teams;

class LoadTeamsData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $teamsNames = array(
            'BemaSport',
            'FC Akapulko',
            'Oldboje Wełny',
            'Proaction',
            'FC Fanatyk',
            'FC Kakulin',
            'The Reds',
            'FC Krecik Team',
            'SK Galaxy',
            'Overmax',
            'Orange Power',
            'Petarda Team'
        );

        foreach ($teamsNames as $team) {
            $newTeam = new Teams();
            $newTeam->setName($team);

            $manager->persist($newTeam);
        }
        $manager->flush();
    }
} 