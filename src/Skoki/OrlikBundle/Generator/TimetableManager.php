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
                $roundTimestamp = $match->getRounds()->getDate()->format('U');
                $tempTab[$match->getRoundId()]['roundNumber'] = $match->getRoundOrder();
                $tempTab[$match->getRoundId()]['roundDate'] = $roundTimestamp;
                if ($nowDate > $roundTimestamp) {
                    $tempTab[$match->getRoundId()]['status'] = 0;
                } else {
                    if ($flagPrev) {
                        $flagPrev = false;
                        if ($lastRoundId != null) {
                            $tempTab[$lastRoundId]['status'] = 2;
                        }
                    }
                    $tempTab[$match->getRoundId()]['status'] = 1;
                }
                $lastRoundId = $match->getRoundId();

                $tempTab[$match->getRoundId()]['matches'][$match->getMatchDate()->format('H:i')] = $this->matchManager->getMatchDetails($match);
            }
        }

        return $tempTab;
    }

} 