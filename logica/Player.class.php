<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Playerclass
 *
 * @author rodrigo
 */
class Player {

    //put your code here

    private $id;
    private $name;
    private $auxGoals;
    private $auxPlayed;
    private $image;

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        if (strcmp($this->image, "-") == 0)
            return 'images/avatar.png';
        return $this->image;
    }

    public function getAuxPlayed() {
        return $this->auxPlayed;
    }

    public function setAuxPlayed($auxPlayed) {
        $this->auxPlayed = $auxPlayed;
    }

    public function getAuxGoals() {
        return $this->auxGoals;
    }

    public function setAuxGoals($auxGoals) {
        $this->auxGoals = $auxGoals;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function hasImage() {
        if (strcmp($this->image, "-") == 0)
            return false;
        return true;
    }

    public static function savePlayer($name) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per1 = new Persistencia("INSERT");
        $per1->setTable("player");
        $per1->addColum('nombre');

        $per1->addValue("'" . $name . "'");

        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);

        $per = new Persistencia("SELECT");
        $per->addColum("id");
        $per->setTable("player");
        $per->addOrderBy("id DESC");
        $per->addLimit(0, 1);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        return $auxDatos[0];
    }

    /**
     * @author Rodrigo Santellan
     * @return Player 
     */
    public static function getPlayerAdmin($id, $add_requiered = true) {
        if ($add_requiered) {
            require_once '../persistencia/dBase.php';
            require_once '../persistencia/persistencia.php';
            require_once '../persistencia/laligadel5DBase.php';
        }


        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("*");
        $per->setTable("player");
        $per->addWhere("id =" . $id);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        //print_r($str);
        $auxDatos = $per->returnValores();
        if (count($auxDatos) > 0) {
            $player = new Player();
            $player->setId($auxDatos[0]);
            $player->setName($auxDatos[1]);
            $player->setImage($auxDatos[2]);
            return $player;
        } else {
            return null;
        }
    }

    /**
     * @author Rodrigo Santellan
     * @return Player 
     */
    public static function updatePlayerAvatar($id, $file) {

        require_once '../persistencia/dBase.php';
        require_once '../persistencia/persistencia.php';
        require_once '../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('update');

        $per->addColum("image");
        $per->addValue($file);
        $per->setTable("player");
        $per->addWhere("id =" . $id);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        return true;
    }

    public static function getAllPlayersAdmin() {

        require_once '../persistencia/dBase.php';
        require_once '../persistencia/persistencia.php';
        require_once '../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("*");
        $per->setTable("player");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 3 <= count($auxDatos)) {
            $player = new Player();
            $player->setId($auxDatos[$index]);
            $player->setName($auxDatos[$index + 1]);
            $player->setImage($auxDatos[$index + 2]);
            array_push($list, $player);
            $index = $index + 3;
        }
        return $list;
    }

    public static function getAllByTournament($tournament_id) {

        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("p.*, sum(tpr.goals) as goals, count( tpr.id_player ) AS played ");
        $per->setTable("player as p, team_player_round as tpr, rounds as r");
        $per->addWhere("p.id = tpr.id_player");
        $per->addWhere("tpr.id_round = r.id");
        $per->addWhere("r.id_tournament = ".$tournament_id);
        $per->addGroupBy(" tpr.id_player");
        $per->addOrderBy('goals desc');
        $str = $per->constructQuery();

        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 5 <= count($auxDatos)) {
            $player = new Player();
            $player->setId($auxDatos[$index]);
            $player->setName($auxDatos[$index + 1]);
            $player->setImage($auxDatos[$index + 2]);
            $player->setAuxGoals($auxDatos[$index + 3]);
            $player->setAuxPlayed($auxDatos[$index + 4]);
            $list[$player->getId()] = $player;
            $index = $index + 5;
        }
        return $list;
    }

    public static function getAll() {

        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("p.*, sum(tpr.goals) as goals, count( tpr.id_player ) AS played ");
        $per->setTable("player as p, team_player_round as tpr");
        $per->addWhere("p.id = tpr.id_player");
        $per->addGroupBy(" tpr.id_player");
        $per->addOrderBy('goals desc');
        $str = $per->constructQuery();

        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 5 <= count($auxDatos)) {
            $player = new Player();
            $player->setId($auxDatos[$index]);
            $player->setName($auxDatos[$index + 1]);
            $player->setImage($auxDatos[$index + 2]);
            $player->setAuxGoals($auxDatos[$index + 3]);
            $player->setAuxPlayed($auxDatos[$index + 4]);
            $list[$player->getId()] = $player;
            $index = $index + 5;
        }
        return $list;
    }

    public static function getTeamRoundPlayers($team_id, $round_id) {
        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("p.*, sum(tpr.goals) as goals, count( tpr.id_player ) AS played ");
        $per->setTable("player as p, team_player_round as tpr");
        $per->addWhere("p.id = tpr.id_player");
        $per->addWhere("tpr.id_team =" . $team_id);
        $per->addWhere("tpr.id_round =" . $round_id);
        $per->addGroupBy(" tpr.id_player");
        $per->addOrderBy('goals desc');
        $str = $per->constructQuery();

        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 4 <= count($auxDatos)) {
            $player = new Player();
            $player->setId($auxDatos[$index]);
            $player->setName($auxDatos[$index + 1]);
            $player->setImage($auxDatos[$index + 2]);
            $player->setAuxGoals($auxDatos[$index + 3]);
            $player->setAuxPlayed($auxDatos[$index + 4]);
            array_push($list, $player);
            $index = $index + 5;
        }
        return $list;
    }

    public static function getTeamRoundPlayersAdmin($team_id, $round_id) {
        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("p.*, sum(tpr.goals) as goals, count( tpr.id_player ) AS played ");
        $per->setTable("player as p, team_player_round as tpr");
        $per->addWhere("p.id = tpr.id_player");
        $per->addWhere("tpr.id_team =" . $team_id);
        $per->addWhere("tpr.id_round =" . $round_id);
        $per->addGroupBy(" tpr.id_player");
        $per->addOrderBy('goals desc');
        $str = $per->constructQuery();

        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 4 <= count($auxDatos)) {
            $player = new Player();
            $player->setId($auxDatos[$index]);
            $player->setName($auxDatos[$index + 1]);
            $player->setImage($auxDatos[$index + 2]);
            $player->setAuxGoals($auxDatos[$index + 3]);
            $player->setAuxPlayed($auxDatos[$index + 4]);
            array_push($list, $player);
            $index = $index + 5;
        }
        return $list;
    }

    public static function getPlayersOfLastRound() {
        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("p.*");
        $per->setTable("player as p");
        $per->addWhere("
            p.id IN (
				SELECT tp.id_player
				FROM team_player_round tp
				WHERE id_round
				IN (
				
					SELECT r.id
					FROM rounds r
						WHERE id = (
						SELECT max( r1.id )
						FROM rounds r1 )
						)
			) 

");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 2 <= count($auxDatos)) {
            $player = new Player();
            $player->setId($auxDatos[$index]);
            $player->setName($auxDatos[$index + 1]);
            $player->setImage($auxDatos[$index + 2]);
            array_push($list, $player);
            $index = $index + 3;
            $indexAux++;
        }
        return $list;
    }

    public static function getPlayersOfATeam($teamId, $requiered = true) {
        if ($requiered) {
            require_once './persistencia/dBase.php';
            require_once './persistencia/persistencia.php';
            require_once './persistencia/laligadel5DBase.php';
        }


        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("p.*");
        $per->setTable("player as p");
        $per->addWhere("
            p.id IN (
				SELECT tp.id_player
				FROM team_player_round tp
				WHERE tp.id_team = " . $teamId . ")");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 2 <= count($auxDatos)) {
            $player = new Player();
            $player->setId($auxDatos[$index]);
            $player->setName($auxDatos[$index + 1]);
            $player->setImage($auxDatos[$index + 2]);
            array_push($list, $player);
            $index = $index + 3;
            $indexAux++;
        }
        return $list;
    }

    public static function removePlayer($player, $strict = false, $requiered = true, $admin = true) {
        if ($requiered) {

            require_once '../../persistencia/dBase.php';
            require_once '../../persistencia/persistencia.php';
            require_once '../../persistencia/laligadel5DBase.php';
        }
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        if (!$strict) {

            $per = new Persistencia('select');

            $per->addColum("id_player");
            $per->setTable("team_player_round");
            $per->addWhere('id_player = ' . $player);
            $str = $per->constructQuery();
            $result = $per->doQuery($str);
            $per->viewData($result);
            $auxDatos = $per->returnValores();
            if (count($auxDatos) > 0) {
                return count($auxDatos);
            }
        }
        $per = new Persistencia('delete');
        $per->setTable("team_player_round");
        $per->addWhere('id_player = ' . $player);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);

        $per = new Persistencia('delete');
        $per->setTable("player");
        $per->addWhere('id = ' . $player);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        return 0;
    }

}

