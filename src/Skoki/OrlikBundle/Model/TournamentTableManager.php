<?php

namespace Skoki\OrlikBundle\Model;

use Skoki\OrlikBundle\Entity\Teams;

class TournamentTableManager {

    public $teamName;
    public $teamId;
    public $teamMatchesPlayed;
    public $teamWins;
    public $teamLoses;
    public $teamDraws;
    public $teamGoals;
    public $teamLostGoals;
    public $teamPkt;
    public $teamReds;
    public $teamYellows;
    public $teamForm;

    public function __construct($teamName = '', $teamId = null)
    {
        $this->teamName = $teamName;
        $this->teamId = $teamId;
        $this->teamMatchesPlayed = 0;
        $this->teamWins = 0;
        $this->teamLoses = 0;
        $this->teamDraws = 0;
        $this->teamGoals = 0;
        $this->teamLostGoals = 0;
        $this->teamPkt = 0;
        $this->teamReds = 0;
        $this->teamYellows = 0;
        $this->teamForm = array();
    }

    public function addWin($score = 0, $lost = 0, $red = 0, $yellow = 0)
    {
        $this->teamMatchesPlayed++;
        $this->teamPkt += 3;
        $this->teamWins++;
        $this->teamGoals += $score;
        $this->teamLostGoals += $lost;
        $this->teamReds += $red;
        $this->teamYellows += $yellow;
    }

    public function addLost($score = 0, $lost = 0, $red = 0, $yellow = 0)
    {
        $this->teamMatchesPlayed++;
        $this->teamLoses++;
        $this->teamGoals += $score;
        $this->teamLostGoals += $lost;
        $this->teamReds += $red;
        $this->teamYellows += $yellow;
    }

    public function addDraw($score = 0, $lost = 0, $red = 0, $yellow = 0)
    {
        $this->teamMatchesPlayed++;
        $this->teamPkt += 1;
        $this->teamDraws++;
        $this->teamGoals += $score;
        $this->teamLostGoals += $lost;
        $this->teamReds += $red;
        $this->teamYellows += $yellow;
    }


}