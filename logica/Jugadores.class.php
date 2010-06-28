<?php

class Jugadores {

    private $id;
    private $nombre;
    private $email;
    private $pj;
    private $goles;

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $nombre
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @return the $email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return the $pj
     */
    public function getPj() {
        return $this->pj;
    }

    /**
     * @return the $goles
     */
    public function getGoles() {
        return $this->goles;
    }

    /**
     * @param $id the $id to set
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param $nombre the $nombre to set
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * @param $email the $email to set
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param $pj the $pj to set
     */
    public function setPj($pj) {
        $this->pj = $pj;
    }

    /**
     * @param $goles the $goles to set
     */
    public function setGoles($goles) {
        $this->goles = $goles;
    }

    public static function getAll() {


        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("*");
        $per->setTable("jugadores");
        $per->addOrderBy('goles DESC');
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 5 <= count($auxDatos)) {
            $jugador = new Jugadores();
            $jugador->setId($auxDatos[$index]);
            $jugador->setNombre($auxDatos[$index + 1]);
            $jugador->setPj($auxDatos[$index + 2]);
            $per1 = new Persistencia('select');
            $per1->addColum("SUM( goles ) ");
            $per1->setTable("jugador_fecha");
            $per1->addWhere('id_jugador = ' . $jugador->getId());
            $str = $per1->constructQuery();
            $result = $per1->doQuery($str);
            $per1->viewData($result);
            $auxDatos1 = $per1->returnValores();
            $jugador->setGoles($auxDatos1[0]);
            $jugador->setEmail($auxDatos[$index + 4]);
            array_push($list, $jugador);
            $index = $index + 5;
        }
        return $list;
    }

    public static function getJugadoresPorFechaYEquipo($fecha, $equipo) {
        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("*");
        $per->setTable("jugadores");
        $per->addWhere('id IN (SELECT id_jugador FROM jugador_fecha WHERE id_fecha ="' . $fecha . '" AND id_equipo = "' . $equipo . '")');
        $per->addOrderBy('goles DESC');
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 5 <= count($auxDatos)) {
            $jugador = new Jugadores();
            $jugador->setId($auxDatos[$index]);
            $jugador->setNombre($auxDatos[$index + 1]);
            $jugador->setPj($auxDatos[$index + 2]);
            $per1 = new Persistencia('select');
            $per1->addColum("SUM( goles ) ");
            $per1->setTable("jugador_fecha");
            $per1->addWhere('id_jugador = ' . $jugador->getId());
            $per1->addWhere('id_fecha = ' . $fecha);
            $str = $per1->constructQuery();
            $result = $per1->doQuery($str);
            $per1->viewData($result);
            $auxDatos1 = $per1->returnValores();
            $jugador->setGoles($auxDatos1[0]);
            $jugador->setEmail($auxDatos[$index + 4]);
            array_push($list, $jugador);
            $index = $index + 5;
        }
        return $list;
    }

}

