<?php

namespace Skoki\OrlikBundle\Generator;

use Skoki\OrlikBundle\Model\MatchManager;
use Doctrine\ORM\EntityManager;

class TimetableManager
{
    protected $em;
    protected $conn;
    protected $roundRepo;
    protected $tournamentId;
    protected $tabela;
    protected $matchManager;

    public function __construct(EntityManager $entityManager, MatchManager $matchManager)
    {
        $this->em = $entityManager;
        $this->roundRepo = $entityManager->getRepository('SkokiOrlikBundle:Rounds');
        $this->matchManager = $matchManager;
    }

    /**
     * @param array $list - array of Matches object
     *
     * @return array - transormed data from list array
     *
     * array('round_id' => array(
     *      'roundNumber' => X,
     *      'matches' => array(
     *          '13:10' => array( 'match_id' => Y, 'home_id' => Z, 'away_id' => W, itd... ),
     *          '14:00' => array( 'match_id' => Y, 'home_id' => Z, 'away_id' => W, itd... ),
     *          '14:40' => itd...
     *      )
     * ))
     *
     */
    public function getTimetable($list)
    {
        $tempTab = array();

        $nowDate = new \DateTime();
        $nowDate = $nowDate->format('U');
        $flagPrev = true;
        $lastRoundId = null;
        if (!empty($list)) {
            foreach ($list as $match) {
                //var_dump($match->getRoundOrder(), $match->getRounds()->getDate()->format('d/m/Y'), $match->getId());
                $roundTimestamp = $match->getRounds()->getDate()->format('U');
                $tempTab[$match->getRoundId()]['roundNumber'] = $match->getRoundOrder();
                $tempTab[$match->getRoundId()]['roundDate'] = intval($roundTimestamp);
                if ($nowDate > $roundTimestamp) {
                    $tempTab[$match->getRoundId()]['status'] = 0; //prev
                } else {
                    if ($flagPrev) {
                        $flagPrev = false;
                        $tempTab[$match->getRoundId()]['status'] = 3; //nextone
                        if ($lastRoundId != null) {
                            $tempTab[$lastRoundId]['status'] = 2; //lastone
                        }

                    }
                    if (!isset($tempTab[$lastRoundId]['status'])) {
                        $tempTab[$match->getRoundId()]['status'] = 1; //next
                    }
                }
                $lastRoundId = $match->getRoundId();

                $tempTab[$match->getRoundId()]['matches'][$match->getMatchDate()->format('H:i')] = $this->matchManager->getMatchDetails($match);
            }
        }

        return $tempTab;
    }

} 