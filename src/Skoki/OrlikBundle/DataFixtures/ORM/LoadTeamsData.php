<?php

namespace Skoki\OrlikBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Skoki\OrlikBundle\Entity\Teams;
use Skoki\OrlikBundle\Entity\Tournaments;
use Skoki\OrlikBundle\Entity\TournamentTeam;
use Skoki\OrlikBundle\Entity\Rounds;

class LoadTeamsData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $teamsNames = array(
            'BemaSport',
            'FC Akapulko',
            'Oldboje Wełny',
            'Proaction',
            'FC Fanatyk',
            'FC Kakulin',
            'The Reds',
            'FC Krecik Team',
            'SK Galaxy',
            'Overmax',
            'Orange Power',
            'Petarda Team'
        );

        foreach ($teamsNames as $team) {
            $newTeam = new Teams();
            $newTeam->setName($team);

            $manager->persist($newTeam);
        }
        $manager->flush();

        /*
         * StatTable Update
         ALTER TABLE stattable DROP FOREIGN KEY FK_C974A9AE296CD8AE; DROP INDEX UNIQ_C974A9AE296CD8AE ON stattable;
         *
         *
         *  update stat table and tournaments
         * ALTER TABLE stattable ADD tournament INT DEFAULT NULL, ADD poz INT DEFAULT NULL;
         * ALTER TABLE stattable ADD CONSTRAINT FK_8A440409BD5FB8D9 FOREIGN KEY (tournament) REFERENCES tournaments (id);
         * CREATE INDEX IDX_8A440409BD5FB8D9 ON stattable (tournament);
         *
         * ALTER TABLE comment DROP body, DROP ancestors, DROP depth, DROP created_at, DROP state;
ALTER TABLE players ADD pozycja VARCHAR(100) DEFAULT NULL, CHANGE firstname firstname VARCHAR(100) DEFAULT NULL, CHANGE lastname lastname VARCHAR(100) DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE height height INT DEFAULT NULL, CHANGE country country VARCHAR(100) DEFAULT NULL, CHANGE other other LONGTEXT DEFAULT NULL;
ALTER TABLE thread DROP permalink, DROP is_commentable, DROP num_comments, DROP last_comment_at;
         */
        //        INSERT INTO `pilka`.`tournament_teams` (`id`, `tournament_id`, `team_id`) VALUES (NULL, '1', '1'),(NULL, '1', '2'),(NULL, '1', '3'),(NULL, '1', '4'),(NULL, '1', '5'),(NULL, '1', '6'),(NULL, '1', '7'),(NULL, '1', '8'),(NULL, '1', '9'),(NULL, '1', '10'),(NULL, '1', '11'),(NULL, '1', '12')

        //ROUNDS
        /*
        INSERT INTO `aronet_orlik`.`rounds` (`id`, `tournament`, `date`, `comment`, `place`, `torder`) VALUES (NULL, '1', '2014-05-10', NULL, NULL, '1'), (NULL, '1', '2014-05-17', NULL, NULL, '2'),
(NULL, '1', '2014-05-24', NULL, NULL, '3'),
(NULL, '1', '2014-06-07', NULL, NULL, '4'),
(NULL, '1', '2014-06-14', NULL, NULL, '5'),
(NULL, '1', '2014-06-21', NULL, NULL, '6'),
(NULL, '1', '2014-06-21', NULL, NULL, '7'),
(NULL, '1', '2014-06-28', NULL, NULL, '8'),
(NULL, '1', '2014-07-05', NULL, NULL, '9'),
(NULL, '1', '2014-07-12', NULL, NULL, '10'),
(NULL, '1', '2014-07-19', NULL, NULL, '11');
         */

        /* ROUND MATCHES - first round
INSERT INTO `aronet_orlik`.`matches` (`id`, `round`, `home`, `away`, `matchDate`, `result`, `score_home`, `score_away`, `red_home`, `red_away`, `yellow_home`, `yellow_away`) VALUES
(NULL, '1', '5', '4', '2014-05-10 13:50:00', '1 - 1', '1', '1', NULL, NULL, NULL, NULL),
(NULL, '1', '6', '11', '2014-05-10 14:50:00', '11 - 2', '11', '2', NULL, NULL, NULL, NULL),
(NULL, '1', '3', '9', '2014-05-10 15:30:00', '6 - 0', '6', '0', NULL, NULL, NULL, NULL),
(NULL, '1', '1', '12', '2014-05-10 16:20:00', '5 - 0', '5', '0', NULL, NULL, NULL, NULL),
(NULL, '1', '2', '10', '2014-05-10 17:10:00', '11 - 0', '11', '0', NULL, NULL, NULL, NULL),
(NULL, '1', '7', '8', '2014-05-10 18:00:00', '4 - 5', '4', '5', NULL, NULL, NULL, NULL);

(NULL, '2', '12', '7', '2014-05-17 13:50:00', '3 - 2', '3', '2', NULL, NULL, NULL, NULL),
(NULL, '2', '1', '10', '2014-05-17 14:50:00', '2 - 11', '2', '11', NULL, NULL, NULL, NULL),
(NULL, '2', '11', '3', '2014-05-17 15:30:00', '2 - 9', '2', '9', NULL, NULL, NULL, NULL),
(NULL, '2', '4', '6', '2014-05-17 16:20:00', '2 - 3', '2', '3', NULL, NULL, NULL, NULL),
(NULL, '2', '8', '5', '2014-05-17 17:10:00', '6 - 3', '6', '3', NULL, NULL, NULL, NULL),
(NULL, '2', '9', '2', '2014-05-17 18:00:00', '3 - 6', '3', '6', NULL, NULL, NULL, NULL);

INSERT INTO `aronet_orlik`.`matches` (`id`, `round`, `home`, `away`, `matchDate`, `result`, `score_home`, `score_away`, `red_home`, `red_away`, `yellow_home`, `yellow_away`) VALUES
(NULL, '3', '6', '8', '2014-05-24 13:50:00', '3-5', '3', '5', NULL, NULL, NULL, NULL),
(NULL, '3', '2', '11', '2014-05-24 14:50:00', '8-0', '8', '0', NULL, NULL, NULL, NULL),
(NULL, '3', '9', '1', '2014-05-24 15:30:00', '1-11', '1', '11', NULL, NULL, NULL, NULL),
(NULL, '3', '12', '10', '2014-05-24 16:20:00', '3-1', '3', '1', NULL, NULL, NULL, NULL),
(NULL, '3', '7', '5', '2014-05-24 17:10:00', '3-4', '3', '4', NULL, NULL, NULL, NULL),
(NULL, '3', '4', '3', '2014-05-24 18:00:00', '0 - 1', '0', '1', NULL, NULL, NULL, NULL),

(NULL, '4', '8', '3', '2014-05-31 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '4', '4', '2', '2014-05-31 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '4', '5', '6', '2014-05-31 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '4', '7', '10', '2014-05-31 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '4', '11', '1', '2014-05-31 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '4', '12', '9', '2014-05-31 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(NULL, '5', '10', '9', '2014-06-07 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '5', '11', '12', '2014-06-07 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '5', '1', '4', '2014-06-07 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '5', '2', '8', '2014-06-07 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '5', '3', '5', '2014-06-07 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '5', '6', '7', '2014-06-07 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(NULL, '6', '6', '3', '2014-06-14 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '6', '5', '2', '2014-06-14 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '6', '4', '12', '2014-06-14 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '6', '7', '9', '2014-06-14 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '6', '11', '10', '2014-06-14 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '6', '1', '8', '2014-06-14 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(NULL, '7', '9', '11', '2014-06-21 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '7', '10', '4', '2014-06-21 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '7', '8', '12', '2014-06-21 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '7', '1', '5', '2014-06-21 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '7', '2', '6', '2014-06-21 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '7', '3', '7', '2014-06-21 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(NULL, '8', '1', '6', '2014-06-28 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '8', '2', '3', '2014-06-28 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '8', '5', '12', '2014-06-28 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '8', '9', '4', '2014-06-28 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '8', '7', '11', '2014-06-28 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '8', '8', '10', '2014-06-28 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(NULL, '9', '2', '7', '2014-07-05 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '9', '6', '12', '2014-07-05 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '9', '10', '5', '2014-07-05 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '9', '9', '8', '2014-07-05 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '9', '11', '4', '2014-07-05 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '9', '1', '3', '2014-07-05 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(NULL, '10', '12', '3', '2014-07-12 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '10', '5', '9', '2014-07-12 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '10', '7', '4', '2014-07-12 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '10', '6', '10', '2014-07-12 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '10', '2', '1', '2014-07-12 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '10', '8', '11', '2014-07-12 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),

(NULL, '11', '1', '7', '2014-07-19 14:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '11', '12', '2', '2014-07-19 15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '11', '3', '10', '2014-07-19 16:20:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '11', '4', '8', '2014-07-19 17:10:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '11', '11', '5', '2014-07-19 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, '11', '6', '9', '2014-07-19 18:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL)
         */


        /*
         * CREATE TABLE cup_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE cup_group_team (id INT AUTO_INCREMENT NOT NULL, cup_group INT DEFAULT NULL, cup_team INT DEFAULT NULL, place INT NOT NULL, INDEX IDX_47E021ADDD05EFEA (cup_group), INDEX IDX_47E021ADD1D3AB65 (cup_team), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE cup_match (id INT AUTO_INCREMENT NOT NULL, cup_group INT NOT NULL, match_date DATETIME NOT NULL, team_home INT NOT NULL, team_away INT NOT NULL, home_score INT NOT NULL, away_score INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE cup_team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo LONGTEXT DEFAULT NULL, cup INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE cup_group_team ADD CONSTRAINT FK_47E021ADDD05EFEA FOREIGN KEY (cup_group) REFERENCES cup_group (id);
ALTER TABLE cup_group_team ADD CONSTRAINT FK_47E021ADD1D3AB65 FOREIGN KEY (cup_team) REFERENCES cup_team (id);


        ALTER TABLE cup_group_team CHANGE place place INT DEFAULT NULL;
ALTER TABLE cup_match ADD result VARCHAR(255) DEFAULT NULL, CHANGE home_score home_score INT DEFAULT NULL, CHANGE away_score away_score INT DEFAULT NULL;
ALTER TABLE cup_team CHANGE cup cup INT DEFAULT NULL;
         */

        /*

        CREATE TABLE player_cards (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, match_id INT DEFAULT NULL, card_type VARCHAR(255) NOT NULL, number INT NOT NULL, INDEX IDX_BBB023BB99E6F5DF (player_id), INDEX IDX_BBB023BB2ABEACD6 (match_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE player_goals (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, match_id INT DEFAULT NULL, score INT NOT NULL, INDEX IDX_7856656999E6F5DF (player_id), INDEX IDX_785665692ABEACD6 (match_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE player_cards ADD CONSTRAINT FK_BBB023BB99E6F5DF FOREIGN KEY (player_id) REFERENCES players (id);
ALTER TABLE player_cards ADD CONSTRAINT FK_BBB023BB2ABEACD6 FOREIGN KEY (match_id) REFERENCES matches (id);
ALTER TABLE player_goals ADD CONSTRAINT FK_7856656999E6F5DF FOREIGN KEY (player_id) REFERENCES players (id);
ALTER TABLE player_goals ADD CONSTRAINT FK_785665692ABEACD6 FOREIGN KEY (match_id) REFERENCES matches (id);

ALTER TABLE player_cards CHANGE card_type card_type VARCHAR(255) DEFAULT NULL, CHANGE number number INT DEFAULT NULL;
ALTER TABLE player_goals CHANGE score score INT DEFAULT NULL;
ALTER TABLE players ADD image VARCHAR(255) DEFAULT NULL;


         */
    }
}