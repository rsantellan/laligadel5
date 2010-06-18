<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of TeamPlayerRoundclass
 *
 * @author rodrigo
 */
class TeamPlayerRound {
    //put your code here

    private $id_player;
    private $id_team;
    private $id_round;
    private $goals;

    public function getId_player() {
        return $this->id_player;
    }

    public function setId_player($id_player) {
        $this->id_player = $id_player;
    }

    public function getId_team() {
        return $this->id_team;
    }

    public function setId_team($id_team) {
        $this->id_team = $id_team;
    }

    public function getId_round() {
        return $this->id_round;
    }

    public function setId_round($id_round) {
        $this->id_round = $id_round;
    }

    public function getGoals() {
        return $this->goals;
    }

    public function setGoals($goals) {
        $this->goals = $goals;
    }

    public static function saveTeamPlayerRound($team_id, $player_id, $round_id, $goals) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );
        $per = new Persistencia("select");
        $per->setTable("team_player_round");
        $per->addColum ( 'count(id_player)' );
        $per->addWhere('id_player ='.$player_id);
        $per->addWhere('id_team = '.$team_id);
        $per->addWhere('id_round = '.$round_id);
        $str = $per->constructQuery ();
        $result = $per->doQuery ( $str );
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $alreadyPlayed = false;
        if($auxDatos[0] > 0) {
            $per = new Persistencia("update");
            $per->setTable("team_player_round");
            $per->addColum ( 'goals' );
            $per->addValue($goals);
            $per->addWhere('id_player ='.$player_id.' and id_team = '.$team_id. ' and id_round ='.$round_id);
            $str = $per->constructQuery ();
            $result = $per->doQuery ( $str );
            return $result;
        }else {
            $per1 = new Persistencia ( "INSERT" );
            $per1->setTable("team_player_round");
            $per1->addColum ( 'id_player' );
            $per1->addColum ( 'id_team' );
            $per1->addColum ( 'id_round' );
            $per1->addColum ( 'goals' );
            $per1->addValue ( $player_id);
            $per1->addValue ( $team_id);
            $per1->addValue ( $round_id);
            $per1->addValue ( $goals);
            $str = $per1->constructQuery ();
            $result = $per1->doQuery ( $str );
            return $result;
        }
    }
}

