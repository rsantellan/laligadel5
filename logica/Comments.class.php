<?php

class Comments {

    private $id;
    private $name;
    private $email;
    private $comment;
    private $date;

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }
    /**
     * @param $date the $date to set
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return the $date
     */
    public function getDate() {
        $date = $this->date;
        return $date;
    }


    /**
     * @return the $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return the $email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return the $comment
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @param $id the $id to set
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param $name the $name to set
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param $email the $email to set
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param $comment the $comment to set
     */
    public function setComment($comment) {
        $this->comment = $comment;
    }


    private $requiere = false;

    private function addRequiered() {
        if(!$this->requiere) {
            require_once './persistencia/dBase.php';
            require_once './persistencia/persistencia.php';
            require_once './persistencia/laligadel5DBase.php';
            $this->requiere = true;
        }
    }

    public static function getAllComents($limitStart = 0, $limitEnd = 0) {

        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );
        $per = new Persistencia ( 'select' );

        $per->addColum ( "*" );
        $per->setTable ( "comments" );
        $per->addOrderBy('date DESC');
        if($limitEnd != 0){
            $per->addLimit($limitStart, $limitEnd);
        }
        $str = $per->constructQuery ();
        $result = $per->doQuery ( $str );
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();

        while($index+5 <= count($auxDatos)) {
            $comment = new Comments();
            $comment->setId($auxDatos[$index]);
            $comment->setName($auxDatos[$index+1]);
            $comment->setEmail($auxDatos[$index+2]);
            $comment->setComment($auxDatos[$index +3]);
            $comment->setDate($auxDatos[$index+4]);
            array_push($list,$comment);
            $index = $index+5;
        }
        return $list;
    }

    public static function saveComment($name, $email, $comment) {

        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );

        $per1 = new Persistencia ( "INSERT" );
        $per1->setTable("comments");
        $per1->addColum ( 'nombre' );
        $per1->addColum ( 'email' );
        $per1->addColum ( 'comentario' );

        $per1->addValue ( "'".$name."'");
        $per1->addValue ( "'".$email."'" );
        $per1->addValue ( "'".$comment."'");

        $str = $per1->constructQuery ();
        $result = $per1->doQuery ( $str );
        return true;
    }
}

