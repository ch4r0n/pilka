<?php

namespace Skoki\OrlikBundle\Generator;

use Skoki\OrlikBundle\Model\MatchManager;
use Skoki\OrlikBundle\Model\TournamentTableManager;

class TableGenerator extends MatchManager
{
    protected $em;
    protected $conn;
    protected $roundRepo;
    protected $teamMatchesRepo;
    protected $tournamentId;
    protected $roundZeroId;
    protected $tabela;

    public function __construct($entityManager, $connection)
    {
        parent::__construct($entityManager);
        $this->em = $entityManager;
        $this->conn = $connection;
        $this->teamMatchsRepo = $entityManager->getRepository('SkokiOrlikBundle:TeamMatches');
        $this->roundRepo = $entityManager->getRepository('SkokiOrlikBundle:Rounds');
    }

    public function getTable($tournamentId = 1)
    {
        $this->tournamentId = $tournamentId;
        $matches = $this->getTournamentMatches();
        $teams = $this->getTournamentTeams();

        $table = array();
        foreach ($teams as $name => $id) {
            $table[$id] = new TournamentTableManager($name, $id);
        }
        foreach ($matches as $match) {
            if ($match['score_home'] > $match['score_away']) {
                $table[$match['home_id']]->addWin($match['score_home'], $match['score_away'], $match['red_home'], $match['yellow_home']);
                $table[$match['away_id']]->addLost($match['score_away'], $match['score_home'], $match['red_away'], $match['yellow_away']);
            } elseif($match['score_home'] < $match['score_away']) {
                $table[$match['home_id']]->addLost($match['score_home'], $match['score_away'], $match['red_home'], $match['yellow_home']);
                $table[$match['away_id']]->addWin($match['score_away'], $match['score_home'], $match['red_away'], $match['yellow_away']);
            } elseif($match['score_home'] == $match['score_away']) {
                $table[$match['home_id']]->addDraw($match['score_home'], $match['score_away'], $match['red_home'], $match['yellow_home']);
                $table[$match['away_id']]->addDraw($match['score_away'], $match['score_home'], $match['red_away'], $match['yellow_away']);
            }
        }
        $this->tabela = $this->orderTabela($table);

        return $this->tabela;
    }

    protected function getTournamentTeams()
    {
        $sql = 'SELECT id, name FROM teams WHERE id in (SELECT team_id FROM tournament_teams WHERE tournament_id = :id) ORDER BY name ASC';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("id", $this->tournamentId);
        $stmt->execute();
        $teamsTab = $stmt->fetchAll();
        $result = array();
        foreach ($teamsTab as $teamId) {
            $result[$teamId['name']] = intval($teamId['id']);
        }
        return $result;
    }

    public function getTournamentMatches()
    {
        $sql = 'SELECT home, away, id, result FROM matches';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $matches = $stmt->fetchAll();
        $teams = $this->getTournamentTeams();
        $tournamentTeams = array();

        foreach ($teams as $teamId) {
            $tournamentTeams[] = $teamId;
        }

        $matchTab = array();
        foreach ($matches as $match) {
            if (in_array(intval($match['home']), $tournamentTeams) && in_array(intval($match['away']), $tournamentTeams)) {
                //$matchTab[intval($match['home'])][] = intval($match['away']);
                if ($match['result'] != '-' && $match['result'] != null) {
                    $matchModel = $this->matchRepo->findOneById(intval($match['id']));
                    $matchTab[$match['id']] = $this->getMatchDetails($matchModel);
                }

            }
        }

        return $matchTab;
    }

    public function orderTabela($tabela)
    {
        $orderedTable = array();
        foreach ($tabela as $teamId => $teamPkt) {
            $orderedTable[$teamId] = $teamPkt->teamPkt;
        }
        arsort($orderedTable);
        $resultTable = array();
        foreach($orderedTable as $teamId => $pkt) {
            $resultTable[$teamId] = $tabela[$teamId];
        }

        return $resultTable;
    }


} 