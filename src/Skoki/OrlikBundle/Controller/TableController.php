<?php

namespace Skoki\OrlikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TableController extends Controller
{
    public function showTableAction()
    {
        return $this->render('SkokiOrlikBundle:Table:ShowTable.html.twig');
    }

    public function tabelaAction($tournamentId = 1)
    {
        $tabelaGenerator = $this->get('orlik.table.generator');
        $tabela = $tabelaGenerator->getTable($tournamentId);

        return $this->render('SkokiOrlikBundle:Table:Tabela.html.twig', array('tabela' => $tabela));
    }
}
