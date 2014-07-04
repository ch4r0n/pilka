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
    protected $match = null;
    protected $scoreHome;
    protected $scoreAway;
    protected $redHome;
    protected $redAway;
    protected $yellowHome;
    protected $yellowAway;
    protected $hour;

    protected $teamsNameArray;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
        $this->matchRepo = $entityManager->getRepository('SkokiOrlikBundle:Matches');
        $this->teamRepo = $entityManager->getRepository('SkokiOrlikBundle:Teams');
    }

    public function getMatchRepo()
    {
        return $this->matchRepo;
    }

    public function getTeamRepo()
    {
        return $this->teamRepo;
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

        $homeName = 'home';
        $awayName = 'away';
        if ($this->home) {
            $homeName = $this->home->getName();
            $homeLogo = $this->home->getPicture();
        }
        if ($this->away) {
            $awayName = $this->away->getName();
            $awayLogo = $this->away->getPicture();
        }

        $kolejka = 'brak';
        if ($this->match->getRounds()) {
            $kolejka = $this->match->getRoundOrder();
        }

        return array(
            'match_id' => $match->getId(),
            'home_id' => $match->getHome(),
            'away_id' => $match->getAway(),
            'home_logo' => $homeLogo,
            'away_logo' => $awayLogo,
            'home_name' => $homeName,
            'away_name' => $awayName,
            'score' => $match->getResult(),
            'round' => $kolejka,
            'round_id' => $match->getRoundId(),
            'round_order' => $match->getRoundOrder(),
            'matchDate' => $match->getMatchDate(),
            'matchHour' => $match->getMatchDate()->format('H:i'),
            'score_home' => $match->getScoreHome(),
            'score_away' => $match->getScoreAway(),
            'red_home' => $match->getRedHome(),
            'red_away' => $match->getRedAway(),
            'yellow_home' => $match->getYellowHome(),
            'yellow_away' => $match->getYellowAway()
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

    /*
     * Metoda zwraca info o ostatnich meczach druzyny
     * array (size=3)
        0 =>
            array (size=4)
              'gdzie' => string 'away' (length=4)
              'stan' => string 'w' (length=1)
              'przeciwnik' => string 'The Reds' (length=8)
              'przeciwnikId' => int 7
        1 =>....
     */
    public function getTeamLastMatches($teamId)
    {
        $teamPlayedMatches = $this->matchRepo->getTeamPlayedMatches($teamId);
        $lastStat = array();

        foreach ($teamPlayedMatches as $match) {
            $result = $match['scoreHome'] - $match['scoreAway'];
            $whowin = 0;
            if ($result > 0) {
                $whowin = 1;
            } elseif ($result < 0) {
                $whowin = 2;
            } elseif ($result == 0) {
                $whowin = 0;
            }
            $where = null;
            $przeciwnik = null;
            $stan = null;
            $formClass = '';
            if ($teamId == $match['home']) {
                $where = 'home';
                $przeciwnik = $match['away'];
                switch($whowin) {
                    case 1:
                        $stan = 'w'; //wygrany
                        $formClass = 'form-win';
                        break;
                    case 2:
                        $stan = 'p'; //przegrany
                        $formClass = 'form-loss';
                        break;
                    default:
                        $stan = 'r';
                        $formClass = 'form-draw';
                        break;
                }
            } elseif ($teamId == $match['away']) {
                $where = 'away';
                $przeciwnik = $match['home'];
                switch($whowin) {
                    case 1:
                        $stan = 'p'; //przegrany
                        $formClass = 'form-loss';
                        break;
                    case 2:
                        $stan = 'w'; //wygrany
                        $formClass = 'form-win';
                        break;
                    default:
                        $stan = 'r';
                        $formClass = 'form-draw';
                        break;
                }
            }
            $teamsNameArray = $this->getTeamsName();
            $lastMatchStat = array(
                'id' => $match['id'],
                'gdzie' => $where,
                'stan' => $stan,
                'class' => $formClass,
                'przeciwnik' => $teamsNameArray[$przeciwnik],
                'przeciwnikId' => $przeciwnik);

            $lastStat[] = $lastMatchStat;
        }

        return $lastStat;
    }

    public function getTeamsName()
    {
        if (isset($this->teamsNameArray)) {
            return $this->teamsNameArray;
        } else {
            $teamsList = $this->teamRepo->findAll();
            $teamsMapArray = array();
            foreach ($teamsList as $team) {
                $teamsMapArray[$team->getId()] = $team->getName();
            }
        }

        return $teamsMapArray;
    }
}