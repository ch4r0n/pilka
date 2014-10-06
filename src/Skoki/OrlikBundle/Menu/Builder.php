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
        $menu->addChild('Tabela', array('route' => '_show_table'));
        $menu->addChild('Drużyny', array('route' => '_show_teams_list'));
        $menu->addChild('Mecze/Wyniki', array('route' => '_orlik_show_timetable'));
        $menu->addChild('Aktualności', array('route' => 'news'));
        $menu->addChild('Regulamin', array('route' => 'orlik_regulamin'));

        return $menu;
    }
}