<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Roundclass
 *
 * @author rodrigo
 */
class Round {
    //put your code here

    private $id;

    private $name;

    private $id_tournament;

    private $tournament_name;

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

    public function getIdTournament() {
        return $this->id_tournament;
    }

    public function setIdTournament($idTournament) {
        $this->id_tournament = $idTournament;
    }

    public function getTournamentName() {
        return $this->tournament_name;
    }

    public function setTournamentName($tournament_name) {
        $this->tournament_name = $tournament_name;
    }



    public static function saveRound($name, $idTournament) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );

        $per1 = new Persistencia ( "INSERT" );
        $per1->setTable("rounds");
        $per1->addColum ( 'nombre' );
        $per1->addColum( 'id_tournament');
        $per1->addValue ( "'".$name."'");
        $per1->addValue($idTournament);
        $str = $per1->constructQuery ();
        $result = $per1->doQuery ( $str );

        $per = new Persistencia("SELECT");
        $per->addColum ( "id" );
        $per->setTable ( "rounds" );
        $per->addOrderBy("id DESC");
        $per->addLimit(0, 1);
        $str = $per->constructQuery ();
        $result = $per->doQuery ( $str );
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        return $auxDatos[0];
    }


    private static function retrieveTournamentName($id) {
        $per = new Persistencia('select');

        $per->addColum("name");
        $per->setTable("tournament");

        $str = $per->constructQuery ();
        $result = $per->doQuery ( $str );
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        if(count($auxDatos) > 0) {
            return $auxDatos[0];
        }
        return ' ';
    }

    public static function retrieveAll($tournament_id, $requiered,$admin, $ajax, $all = false ) {
        if($requiered) {
            if($admin) {
                if($ajax) {
                    require_once '../../persistencia/dBase.php';
                    require_once '../../persistencia/persistencia.php';
                    require_once '../../persistencia/laligadel5DBase.php';
                }else {
                    require_once '../persistencia/dBase.php';
                    require_once '../persistencia/persistencia.php';
                    require_once '../persistencia/laligadel5DBase.php';
                }
            }else {
                if($ajax) {
                    require_once '../persistencia/dBase.php';
                    require_once '../persistencia/persistencia.php';
                    require_once '../persistencia/laligadel5DBase.php';
                }else {
                    require_once './persistencia/dBase.php';
                    require_once './persistencia/persistencia.php';
                    require_once './persistencia/laligadel5DBase.php';
                }
            }
        }

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );
        $per = new Persistencia ( 'select' );

        $per->addColum ( "*" );
        $per->setTable ( "rounds" );
        if(!$all){
            $per->addWhere("id_tournament = ".$tournament_id);
        }
        $per->addOrderBy('id DESC');
        $str = $per->constructQuery ();
        $result = $per->doQuery ( $str );
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while($index+2 <= count($auxDatos)) {
            $round = new Round();
            $round->setId($auxDatos[$index]);
            $round->setName($auxDatos[$index+1]);
            $round->setIdTournament($auxDatos[$index+2]);
            $round->setTournamentName(self::retrieveTournamentName($auxDatos[$index+2]));
            array_push($list,$round);
            $index = $index+3;
        }
        return $list;
    }


    public static function getLastRound() {
        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );
        $per = new Persistencia ( 'select' );

        $per->addColum ( "r.*" );
        $per->setTable ( "rounds r" );
        $per->addWhere("
            id = (
                    select max( tvt.id_round ) from team_vs_team tvt, rounds r1, tournament t
                    where
                      tvt.id_round = r1.id
                    and
                      r1.id_tournament = t.id
                    and
                      t.current = 1
                    )
		");
        $str = $per->constructQuery ();
        $result = $per->doQuery ( $str );
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $round = new Round();
        $round->setId($auxDatos[$index]);
        $round->setName($auxDatos[$index+1]);
        $round->setIdTournament($auxDatos[$index+2]);
        $round->setTournamentName(self::retrieveTournamentName($auxDatos[$index+2]));
        return $round;
    }

    public static function removeRound($round, $strict = false, $requiered = true, $admin = true) {
        if ($requiered) {

            require_once '../../persistencia/dBase.php';
            require_once '../../persistencia/persistencia.php';
            require_once '../../persistencia/laligadel5DBase.php';
        }
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        if (!$strict) {

            $per = new Persistencia('select');

            $per->addColum("id_round");
            $per->setTable("team_player_round");
            $per->addWhere('id_round = ' . $round);
            $str = $per->constructQuery();
            $result = $per->doQuery($str);
            $per->viewData($result);
            $auxDatos = $per->returnValores();
            if (count($auxDatos) > 0) {
                return count($auxDatos);
            }
            $per = new Persistencia('select');

            $per->addColum("id_round");
            $per->setTable("team_vs_team");
            $per->addWhere('id_round = ' . $round);
            $str = $per->constructQuery();
            $result = $per->doQuery($str);
            $per->viewData($result);
            $auxDatos = $per->returnValores();
            if (count($auxDatos) > 0) {
                return count($auxDatos);
            }
        }

        $per = new Persistencia('delete');
        $per->setTable("team_vs_team");
        $per->addWhere('id_round = ' . $round);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);

        $per = new Persistencia('delete');
        $per->setTable("team_player_round");
        $per->addWhere('id_round = ' . $round);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);

        $per = new Persistencia('delete');
        $per->setTable("rounds");
        $per->addWhere('id = ' . $round);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        return 0;
    }

}

