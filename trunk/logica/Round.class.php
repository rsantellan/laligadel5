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

    public static function saveRound($name) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );

        $per1 = new Persistencia ( "INSERT" );
        $per1->setTable("rounds");
        $per1->addColum ( 'nombre' );

        $per1->addValue ( "'".$name."'");

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

    public static function getAllRoundsAdmin() {

        require_once '../persistencia/dBase.php';
        require_once '../persistencia/persistencia.php';
        require_once '../persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );
        $per = new Persistencia ( 'select' );

        $per->addColum ( "*" );
        $per->setTable ( "rounds" );
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
            array_push($list,$round);
            $index = $index+2;
        }
        return $list;
    }
    public static function getAll() {

        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );
        $per = new Persistencia ( 'select' );

        $per->addColum ( "*" );
        $per->setTable ( "rounds" );
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
            array_push($list,$round);
            $index = $index+2;
        }
        return $list;
    }
}

