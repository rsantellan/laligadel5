<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Category
 *
 * @author rodrigo
 */
class Tournament {

    //put your code here
    private $id;
    private $name;
    private $current = false;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCurrent() {
        return $this->current;
    }

    public function setCurrent($current) {
        $this->current = $current;
    }



    /**
     *
     * @param boolean $requiered
     * @param boolean $admin
     * @return array <Tournaments>
     */
    public static function getAllTournaments($onlyCurrent, $requiered = true, $admin = false) {
        if ($requiered) {
            if ($admin) {
                require_once '../persistencia/dBase.php';
                require_once '../persistencia/persistencia.php';
                require_once '../persistencia/laligadel5DBase.php';
            } else {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
            }
        }


        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("*");
        $per->setTable("tournament");
        if($onlyCurrent) {
            $per->addWhere('current = 1');
        }

        $str = $per->constructQuery();

        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        if($onlyCurrent) {
            $tournament = new Tournament();
            $tournament->setId($auxDatos[$index]);
            $tournament->setName($auxDatos[$index + 1]);
            $tournament->setCurrent($auxDatos[$index + 2]);
            return $tournament;
        }

        $list = array();
        while ($index + 2 <= count($auxDatos)) {
            $tournament = new Tournament();
            $tournament->setId($auxDatos[$index]);
            $tournament->setName($auxDatos[$index + 1]);
            $tournament->setCurrent($auxDatos[$index + 2]);
            array_push($list, $tournament);
            $index = $index + 3;
        }
        return $list;
    }

    public static function createTournament($name, $current) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per1 = new Persistencia("INSERT");
        $per1->setTable("tournament");
        $per1->addColum('name');
        $per1->addColum('current');
        $per1->addValue("'" . $name . "'");
        $per1->addValue($current);
        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        $per = new Persistencia("SELECT");
        $per->addColum("id");
        $per->setTable("tournament");
        $per->addOrderBy("id DESC");
        $per->addLimit(0, 1);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        return $auxDatos[0];
    }

    /*
    public static function removeCategory($id) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per1 = new Persistencia("UPDATE");
        $per1->setTable("images_laliga");
        $per1->addColum('categoryId');
        $per1->addValue(0);
        $per1->addWhere('categoryId = '.$id);
        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);

        $per1 = new Persistencia("DELETE");
        $per1->setTable("category");
        $per1->addWhere('id = '.$id);
        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);

        return true;
    }
    */
    public static function makeCurrent($id, $value, $reset = false) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        if($reset) {
            $per1 = new Persistencia("UPDATE");
            $per1->setTable("tournament");
            $per1->addColum('current');
            $per1->addValue(0);
            $per1->addWhere('1 = 1');
            $str = $per1->constructQuery();
            $result = $per1->doQuery($str);
        }


        $per1 = new Persistencia("UPDATE");
        $per1->setTable("tournament");
        $per1->addColum('current');
        $per1->addValue($value);
        $per1->addWhere('id = '.$id);
        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        return true;
    }

}

