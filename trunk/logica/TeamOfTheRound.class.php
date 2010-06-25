<?php

/**
 * Description of EquipoDeLaSemana
 *
 * @author rodrigo
 */
class TeamOfTheRound {

    //put your code here
    private $id;
    private $goaly;
    private $defenderRight;
    private $defenderLeft;
    private $attackerRight;
    private $attackerLeft;
    private $playerGoaly;
    private $playerDefenderRight;
    private $playerDefenderLeft;
    private $playerAttackerRight;
    private $playerAttackerLeft;
    private $author;
    private $round;
    private $rating;
    private $votes;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getGoaly() {
        return $this->goaly;
    }

    public function setGoaly($goaly) {
        $this->goaly = $goaly;
    }

    public function getDefenderRight() {
        return $this->defenderRight;
    }

    public function setDefenderRight($defenderRight) {
        $this->defenderRight = $defenderRight;
    }

    public function getDefenderLeft() {
        return $this->defenderLeft;
    }

    public function setDefenderLeft($defenderLeft) {
        $this->defenderLeft = $defenderLeft;
    }

    public function getAttackerRight() {
        return $this->attackerRight;
    }

    public function setAttackerRight($attackerRight) {
        $this->attackerRight = $attackerRight;
    }

    public function getAttackerLeft() {
        return $this->attackerLeft;
    }

    public function setAttackerLeft($attackerLeft) {
        $this->attackerLeft = $attackerLeft;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getRound() {
        return $this->round;
    }

    public function setRound($round) {
        $this->round = $round;
    }

    /**
     *
     * @return Player
     */
    public function getPlayerGoaly() {
        return $this->playerGoaly;
    }

    public function setPlayerGoaly($playerGoaly) {
        $this->playerGoaly = $playerGoaly;
    }

    /**
     *
     * @return Player
     */
    public function getPlayerDefenderRight() {
        return $this->playerDefenderRight;
    }

    public function setPlayerDefenderRight($playerDefenderRight) {
        $this->playerDefenderRight = $playerDefenderRight;
    }

    /**
     *
     * @return Player
     */
    public function getPlayerDefenderLeft() {
        return $this->playerDefenderLeft;
    }

    public function setPlayerDefenderLeft($playerDefenderLeft) {
        $this->playerDefenderLeft = $playerDefenderLeft;
    }

    /**
     *
     * @return Player
     */
    public function getPlayerAttackerRight() {
        return $this->playerAttackerRight;
    }

    public function setPlayerAttackerRight($playerAttackerRight) {
        $this->playerAttackerRight = $playerAttackerRight;
    }

    /**
     *
     * @return Player
     */
    public function getPlayerAttackerLeft() {
        return $this->playerAttackerLeft;
    }

    public function setPlayerAttackerLeft($playerAttackerLeft) {
        $this->playerAttackerLeft = $playerAttackerLeft;
    }

    public function getRating() {
        return $this->rating;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function getVotes() {
        return $this->votes;
    }

    public function setVotes($votes) {
        $this->votes = $votes;
    }

    public function getCalculatedRating() {
        if ($this->getVotes() == 0) {
            return 0;
        }
        return round(($this->getRating() / $this->getVotes()), 2);
    }

    public function getCalculatedRatingPercent() {
        $rating = $this->getCalculatedRating();
        return ($rating * 100) / 5;
    }

    public static function getTeamOfTheRoundOfOneRound($round, $listOfAllPlayers) {
        //require_once '../persistencia/dBase.php';
        //require_once '../persistencia/persistencia.php';
        //require_once '../persistencia/laligadel5DBase.php';
        require_once 'Player.class.php';
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("*");
        $per->setTable("team_of_the_round");
        $per->addWhere('round = ' . $round);
        $per->addOrderBy('ranking DESC');
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();

        $index = 0;
        $list = array();
        while ($index + 10 <= count($auxDatos)) {
            $teamOfTheRound = new TeamOfTheRound();
            $teamOfTheRound->setId($auxDatos[$index]);
            $teamOfTheRound->setAuthor($auxDatos[$index + 1]);
            $teamOfTheRound->setRound($auxDatos[$index + 2]);

            $teamOfTheRound->setPlayerGoaly($listOfAllPlayers[$auxDatos[$index + 3]]);
            $teamOfTheRound->setPlayerDefenderRight($listOfAllPlayers[$auxDatos[$index + 4]]);
            $teamOfTheRound->setPlayerDefenderLeft($listOfAllPlayers[$auxDatos[$index + 5]]);
            $teamOfTheRound->setPlayerAttackerRight($listOfAllPlayers[$auxDatos[$index + 6]]);
            $teamOfTheRound->setPlayerAttackerLeft($listOfAllPlayers[$auxDatos[$index + 7]]);
            $teamOfTheRound->setRating($auxDatos[$index + 8]);
            $teamOfTheRound->setVotes($auxDatos[$index + 9]);
            array_push($list, $teamOfTheRound);
            $index = $index + 10;
        }
        return $list;
    }

    public static function changeTeamOfTheRoundRating($id, $rating) {
        require_once '../persistencia/dBase.php';
        require_once '../persistencia/persistencia.php';
        require_once '../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per = new Persistencia("SELECT");
        $per->setTable("team_of_the_round");
        $per->addColum("ranking");
        $per->addColum("votes");
        $per->addWhere("id = " . $id);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $per1 = new Persistencia("UPDATE");
        $per1->setTable("team_of_the_round");
        $per1->addColum("ranking");
        $per1->addColum("votes");
        $per1->addValue($auxDatos[0] + $rating);
        $per1->addValue($auxDatos[1] + 1);
        $per1->addWhere("id = " . $id);
        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        return array(0 => $auxDatos[0] + $rating, 1 => $auxDatos[1] + 1);
    }

    public static function saveTeamOfTheRound($goaly, $defenderRight, $defenderLeft, $attackerRight, $attackerLeft, $author, $round) {
        require_once '../persistencia/dBase.php';
        require_once '../persistencia/persistencia.php';
        require_once '../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per1 = new Persistencia("INSERT");
        $per1->setTable("team_of_the_round");
        $per1->addColum('name');
        $per1->addColum('round');
        $per1->addColum('goaly');
        $per1->addColum('defender_right');
        $per1->addColum('defender_left');
        $per1->addColum('attacker_right');
        $per1->addColum('attacker_left');

        $per1->addValue("'" . $author . "'");
        $per1->addValue($round);
        $per1->addValue($goaly);
        $per1->addValue($defenderRight);
        $per1->addValue($defenderLeft);
        $per1->addValue($attackerRight);
        $per1->addValue($attackerLeft);

        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        $per = new Persistencia("SELECT");
        $per->addColum("id");
        $per->setTable("team_of_the_round");
        $per->addOrderBy("id DESC");
        $per->addLimit(0, 1);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        return TeamOfTheRound::getTeamOfTheRoundById($auxDatos[0]);
    }

    public static function getTeamOfTheRoundById($id) {
        //require_once '../persistencia/dBase.php';
        //require_once '../persistencia/persistencia.php';
        //require_once '../persistencia/laligadel5DBase.php';
        require_once 'Player.class.php';
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("*");
        $per->setTable("team_of_the_round");
        $per->addWhere('id = ' . $id);
        $per->addOrderBy('ranking DESC');
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();

        $index = 0;

        $teamOfTheRound = new TeamOfTheRound();
        $teamOfTheRound->setId($auxDatos[$index]);
        $teamOfTheRound->setAuthor($auxDatos[$index + 1]);
        $teamOfTheRound->setRound($auxDatos[$index + 2]);
        
        $teamOfTheRound->setPlayerGoaly(Player::getPlayerAdmin($auxDatos[$index + 3], false));
        
        $teamOfTheRound->setPlayerDefenderRight(Player::getPlayerAdmin($auxDatos[$index + 4], false));
        $teamOfTheRound->setPlayerDefenderLeft(Player::getPlayerAdmin($auxDatos[$index + 5], false));
        $teamOfTheRound->setPlayerAttackerRight(Player::getPlayerAdmin($auxDatos[$index + 6], false));
        $teamOfTheRound->setPlayerAttackerLeft(Player::getPlayerAdmin($auxDatos[$index + 7], false));
        $teamOfTheRound->setRating($auxDatos[$index + 8]);
        $teamOfTheRound->setVotes($auxDatos[$index + 9]);


        return $teamOfTheRound;
    }

}

