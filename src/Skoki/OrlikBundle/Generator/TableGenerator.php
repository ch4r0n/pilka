<?php

namespace Skoki\OrlikBundle\Generator;

use Skoki\OrlikBundle\Model\MatchManager;
use Skoki\OrlikBundle\Model\TournamentTableManager;
use Skoki\OrlikBundle\Entity\StatTable;

class TableGenerator extends MatchManager
{
    protected $em;
    protected $conn;
    protected $roundRepo;
    protected $teamMatchesRepo;
    protected $statRepo;
    protected $tournamentId;
    protected $roundZeroId;
    protected $tabela;
    protected $tournamentTeams = array();
    protected $matches = array();

    public function __construct($entityManager, $connection)
    {
        parent::__construct($entityManager);
        $this->em = $entityManager;
        $this->conn = $connection;
        $this->teamMatchsRepo = $entityManager->getRepository('SkokiOrlikBundle:TeamMatches');
        $this->roundRepo = $entityManager->getRepository('SkokiOrlikBundle:Rounds');
        $this->statRepo = $entityManager->getRepository('SkokiOrlikBundle:StatTable');
    }

    public function updateStatTableData($tournamentId = 1)
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
        $this->tabela = $table;

        $this->updateDbStatTable();
        $tourRep = $this->em->getRepository('SkokiOrlikBundle:Tournaments');
        $tournament = $tourRep->findOneById($tournamentId);

        return $this->getStatTable($tournament);

    }
    public function getTable($tournamentId = 1)
    {
        $this->tournamentId = $tournamentId;
        $tourRep = $this->em->getRepository('SkokiOrlikBundle:Tournaments');
        $tournament = $tourRep->findOneById($tournamentId);
//        $matches = $this->getTournamentMatches();
//        $teams = $this->getTournamentTeams();
//
//        $table = array();
//        foreach ($teams as $name => $id) {
//            $table[$id] = new TournamentTableManager($name, $id);
//        }
//        foreach ($matches as $match) {
//            if ($match['score_home'] > $match['score_away']) {
//                $table[$match['home_id']]->addWin($match['score_home'], $match['score_away'], $match['red_home'], $match['yellow_home']);
//                $table[$match['away_id']]->addLost($match['score_away'], $match['score_home'], $match['red_away'], $match['yellow_away']);
//            } elseif($match['score_home'] < $match['score_away']) {
//                $table[$match['home_id']]->addLost($match['score_home'], $match['score_away'], $match['red_home'], $match['yellow_home']);
//                $table[$match['away_id']]->addWin($match['score_away'], $match['score_home'], $match['red_away'], $match['yellow_away']);
//            } elseif($match['score_home'] == $match['score_away']) {
//                $table[$match['home_id']]->addDraw($match['score_home'], $match['score_away'], $match['red_home'], $match['yellow_home']);
//                $table[$match['away_id']]->addDraw($match['score_away'], $match['score_home'], $match['red_away'], $match['yellow_away']);
//            }
//        }
        $statData = $this->getStatTable($tournament);

        $table = array();
        $poz = 1;
        foreach ($statData as $row) {
            $eamStat = new TournamentTableManager($row->getTeamName(), $row->getTeamId());
            $eamStat->teamMatchesPlayed = $row->getRs();
            $eamStat->teamWins = $row->getZ();
            $eamStat->teamLoses = $row->getP();
            $eamStat->teamDraws = $row->getR();
            $eamStat->teamGoals = $row->getBz();
            $eamStat->teamLostGoals = $row->getBs();
            $eamStat->teamPkt = $row->getPkt();
            $eamStat->teamReds = 0;
            $eamStat->teamYellows = 0;
            $eamStat->teamForm = array();
            $eamStat->pozycja = $poz;
            $table[$row->getTeamId()] = $eamStat;
            $poz++;
        }

        $this->tabela = $table;

        return $this->tabela;
    }

    public function getStatTable($tour)
    {
        $statdata = $this->statRepo->getTournamentStats();

        return $statdata;
    }

    public function updateDbStatTable($tourId = 1)
    {
        if ($this->tabela) {
            foreach ($this->tabela as $teamId => $teamTableRaw) {
                $stat = $this->statRepo->findOneBy(array('teamId' => $teamId));
                if (!$stat) {
                    $stat = New StatTable();
                    $stat->setTeamId($teamId);
                }
                $stat->setTeamName($teamTableRaw->teamName);
                $stat->setRs($teamTableRaw->teamMatchesPlayed);
                $stat->setBz($teamTableRaw->teamGoals);
                $stat->setBs($teamTableRaw->teamLostGoals);
                $stat->setZ($teamTableRaw->teamWins);
                $stat->setR($teamTableRaw->teamDraws);
                $stat->setP($teamTableRaw->teamLoses);
                $stat->setRb($teamTableRaw->teamGoals - $teamTableRaw->teamLostGoals);
                $stat->setPkt($teamTableRaw->teamPkt);

                $this->em->persist($stat);
            }
            $this->em->flush();
        }
    }

    protected function getTournamentTeams()
    {
        if (empty($this->tournamentTeams)) {
            $sql = 'SELECT id, name FROM teams WHERE id in (SELECT team_id FROM tournament_teams WHERE tournament_id = :id) ORDER BY name ASC';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue("id", $this->tournamentId);
            $stmt->execute();
            $teamsTab = $stmt->fetchAll();
            $result = array();
            foreach ($teamsTab as $teamId) {
                $result[$teamId['name']] = intval($teamId['id']);
            }
            $this->tournamentTeams = $result;
        }


        return $this->tournamentTeams;
    }

    public function getTournamentMatches()
    {
        if (empty($this->matches)) {
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
            $this->matches = $matchTab;
        }

        return $this->matches;
    }

    public function orderTabela($tabela)
    {
        $orderedTable = array();
        foreach ($tabela as $teamId => $teamPkt) {
            $orderedTable[$teamId] = $teamPkt->teamPkt;
        }
        arsort($orderedTable);

        // Define the custom sort function
        $resultTable = array();
        foreach($orderedTable as $teamId => $pkt) {
            $resultTable[$teamId] = $tabela[$teamId];
        }
//        $wasTab = array();
//        $pozTab = array();
//        for($i =1;$i<=count($resultTable);$i++){
//            foreach($resultTable as $tid => $teamStat) {
//                if (!in_array($tid, $wasTab)){
//                    $pkt = $teamStat->teamPkt;
//                    $rb = $teamStat->teamLostGoals;
//                    $selected = $tid;
//                    if ($teamStat->teamPkt >= $pkt && $teamStat->teamLostGoals >= $rb) {
//                        $pkt = $teamStat->teamPkt;
//                        $rb = $teamStat->teamLostGoals;
//                        $selected = $tid;
//                        $wasTab[$i] = $tid;
//                    }
//                }
//            }
//            $wasTab[$i] = $selected;
//            $pozTab[$i] = $resultTable[$selected];
//        }
//
//        var_dump($resultTable);die();

        return $resultTable;
    }
    function custom_sort($a,$b) {
        if ($a['pkt'] == $b['pkt']) {
            return $a['rb']>$b['rb'];
        }
        return $a['pkt']>$b['pkt'];
    }


} 