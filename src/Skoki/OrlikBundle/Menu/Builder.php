<?php

namespace Skoki\OrlikBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'orlik_homepage'));
        $menu->addChild('Table', array('route' => '_show_table'));
        $menu->addChild('Teams', array('route' => '_show_teams_list'));
        $menu->addChild('Timetable', array('route' => '_orlik_timetable'));

        return $menu;
    }
}