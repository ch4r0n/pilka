<?php

namespace Skoki\OrlikBundle\Model;

use Doctrine\ORM\EntityManager;
use Skoki\OrlikBundle\Entity\Matches;
use Skoki\OrlikBundle\Entity\TeamMatches;

class MatchManager {

    protected $em;
    protected $matchRepo;
    protected $teamRepo;

    protected $id;
    protected $home_id;
    protected $home;
    protected $away_id;
    protected $away;
    protected $match;
    protected $scoreHome;
    protected $scoreAway;
    protected $redHome;
    protected $redAway;
    protected $yellowHome;
    protected $yellowAway;
    protected $hour;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
        $this->matchRepo = $entityManager->getRepository('SkokiOrlikBundle:Matches');
        $this->teamRepo = $entityManager->getRepository('SkokiOrlikBundle:Teams');
    }

    public function setMatchData(Matches $match)
    {
        $this->match = $match;
        $this->home_id = $match->getHome();
        $this->away_id = $match->getAway();
        $this->home = $this->teamRepo->findOneById($this->home_id);
        $this->away = $this->teamRepo->findOneById($this->away_id);
        $this->scoreHome = $match->getScoreHome();
        $this->scoreAway = $match->getScoreAway();
        $this->redHome = $match->getRedHome();
        $this->redAway = $match->getRedAway();
        $this->yellowHome = $match->getYellowHome();
        $this->yellowAway = $match->getYellowAway();
    }

    public function getMatchTeams()
    {
        return array('home' => $this->home, 'away' => $this->away);
    }

    public function addMatch(Matches $match)
    {
        $this->setMatchData($match);

        if (!$this->checkIfExists($match)) {
            $newMatch = new Matches();
            $newMatch->setHome($this->match->getHome());
            $newMatch->setAway($this->match->getAway());
            $resultData = array(
                'home' => $this->match->getScoreHome(),
                'away' => $this->match->getScoreAway(),
                'result' => $this->match->getResult()
            );
            if ($resultData['home'] && $resultData['away']) {
                $newMatch->setScoreHome($resultData['home']);
                $newMatch->setScoreAway($resultData['away']);
                $newMatch->setResult($resultData['home'].' - '.$resultData['away']);
            }
            $newMatch->setMatchDate($this->match->getMatchDate());

            $newMatch->setRounds($this->match->getRounds());


            $this->em->persist($newMatch);
            $this->em->flush();

            $newTeamMatch = new TeamMatches();
            $newTeamMatch->setTeam($this->home);
            $newTeamMatch->setMatch($newMatch);
            $newTeamMatch->setType(1);

            $newTeamMatch2 = new TeamMatches();
            $newTeamMatch2->setTeam($this->away);
            $newTeamMatch2->setMatch($newMatch);
            $newTeamMatch2->setType(2);

            $this->em->persist($newTeamMatch);
            $this->em->persist($newTeamMatch2);
            $this->em->flush();

            return $newMatch;
        }

        return null;
    }

    public function getMatchDetails(Matches $match = null)
    {
        if ($match !== null) {
            $this->setMatchData($match);
        }

        $kolejka = 'brak';
        if ($this->match->getRounds()) {
            $kolejka = $this->match->getRounds()->getTorder();
        }

        $homeName = 'home';
        $awayName = 'away';
        if ($this->home) {
            $homeName = $this->home->getName();
        }
        if ($this->away) {
            $awayName = $this->away->getName();
        }

        return array(
            'match_id' => $this->match->getId(),
            'home_id' => $this->match->getHome(),
            'away_id' => $this->match->getAway(),
            'home_name' => $homeName,
            'away_name' => $awayName,
            'score' => $this->match->getResult(),
            'round' => $kolejka,
            'round_id' => $this->match->getRoundId(),
            'round_order' => $this->match->getRoundOrder(),
            'matchDate' => $this->match->getMatchDate(),
            'score_home' => $this->scoreHome,
            'score_away' => $this->scoreAway,
            'red_home' => $this->redHome,
            'red_away' => $this->redAway,
            'yellow_home' => $this->yellowHome,
            'yellow_away' => $this->yellowAway
        );
    }

    protected function checkIfExists(Matches $match)
    {
        $m = $this->matchRepo->findOneBy(array(
            'home' => $this->home_id,
            'away' => $this->away_id
        ));
        if ($m) {
            return true;
        } else {
            return false;
        }
    }
} 