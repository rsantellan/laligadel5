<?php

/**
 * Description of EquipoDeLaSemana
 *
 * @author rodrigo
 */
class TeamOfTheRound {

    //put your code here
    private $goaly;
    private $defenderRight;
    private $defenderLeft;
    private $attackerRight;
    private $attackerLeft;
    private $author;
    private $round;

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
        return $auxDatos[0];
    }

}

