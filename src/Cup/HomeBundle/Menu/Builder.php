<?php

namespace Cup\HomeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'cup_home_homepage'));
//        $menu->addChild('Mecze', array('route' => '_cup_home_cup_match'));
//        $menu->addChild('Twoje zaklady', array('route' => '_cup_home_userbeats'));

        return $menu;
    }
}