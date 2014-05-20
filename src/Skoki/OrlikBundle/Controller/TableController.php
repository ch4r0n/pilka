<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableController extends Controller
{
    public function showTableAction()
    {
        return $this->render('SkokiOrlikBundle:Table:ShowTable.html.twig');
    }

}
