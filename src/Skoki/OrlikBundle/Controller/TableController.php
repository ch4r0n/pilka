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
        $matchManager = $this->get('orlik.match.manager');
        foreach ($tabela as $key => $teamRaw) {
            $tabela[$key]->teamForm = $matchManager->getTeamLastMatches($teamRaw->teamId);
        }

        return $this->render('SkokiOrlikBundle:Table:Tabela.html.twig', array('tabela' => $tabela));
    }

    public function showSmallTableAction()
    {
        $tabelaGenerator = $this->get('orlik.table.generator');
        $tabela = $tabelaGenerator->getTable(1);

        return $this->render('SkokiOrlikBundle:Table:SmallTable.html.twig', array('tabela' => $tabela));
    }
}
