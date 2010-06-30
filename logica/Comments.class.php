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
        if (!$this->requiere) {
            require_once './persistencia/dBase.php';
            require_once './persistencia/persistencia.php';
            require_once './persistencia/laligadel5DBase.php';
            $this->requiere = true;
        }
    }

    public static function getAllComents($limitStart = 0, $limitEnd = 0, $required = true, $differentOrder = false, $admin = false) {
        if ($required) {
            if (!$admin) {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
            } else {
                require_once '../../persistencia/dBase.php';
                require_once '../../persistencia/persistencia.php';
                require_once '../../persistencia/laligadel5DBase.php';
            }
        }


        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum("id");
        $per->addColum('nombre');
        $per->addColum('email');
        $per->addColum('comentario');
        $per->addColum('UNIX_TIMESTAMP(`date`)');
        $per->setTable("comments");
        if (!$differentOrder) {
            $per->addOrderBy('date DESC');
        }

        if ($limitEnd != 0) {
            $per->addLimit($limitStart, $limitEnd);
        }
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();

        while ($index + 5 <= count($auxDatos)) {
            $comment = new Comments();
            $comment->setId($auxDatos[$index]);
            $comment->setName($auxDatos[$index + 1]);
            $comment->setEmail($auxDatos[$index + 2]);
            $comment->setComment($auxDatos[$index + 3]);
            $comment->setDate(date("d-m-Y", $auxDatos[$index + 4]));
            array_push($list, $comment);
            $index = $index + 5;
        }
        return $list;
    }

    public static function saveComment($name, $email, $comment) {

        require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per1 = new Persistencia("INSERT");
        $per1->setTable("comments");
        $per1->addColum('nombre');
        $per1->addColum('email');
        $per1->addColum('comentario');

        $per1->addValue("'" . $name . "'");
        $per1->addValue("'" . $email . "'");
        $per1->addValue("'" . $comment . "'");

        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        return true;
    }

    public static function groupAndCountByDay($commentsList) {
        $start = true;
        $last = "";
        $count = 0;
        $return = array();
        $index = 0;
        while ($index < count($commentsList)) {
            $comment = $commentsList[$index];
            if ($last == "") {
                $last = $comment->getDate();
            }
            if ($last != $comment->getDate()) {
                array_push($return, array($comment->getDate(), $count));
                //$return[$comment->getDate()] = $count;
                $count = 0;
                $last = $comment->getDate();
            }
            $count++;
            $index++;
            if ($index == count($commentsList)) {
                array_push($return, array($comment->getDate(), $count));
                $count = 0;
            }
        }
        return $return;
    }

    /**
     *
     * @param Array() name, value $commentsList
     * @return string
     */
    public static function getTableOfComments($commentsList, $texto) {
        $first = 0;
        $first_id = 0;
        $last_id = 0;
        $last = PHP_INT_MAX;
        foreach ($commentsList as $key => $val) {

            if ($val[1] > $first) {
                $first = $val[1];
                $first_id = $key;
            }
            if ($val[1] < $last) {
                $last = $val[1];
                $last_id = $key;
            }
        }

        $auxTable = "<table cellspacing='0' cellpadding='0' summary='".$texto.' '. $commentsList[$first_id][0] . "'>
                                <caption align='top'>".$texto."<br /><br /></caption>
                                <tr>
                                    <th scope='col'><span class='auraltext'>Dia</span> </th>
                                    <th scope='col'><span class='auraltext'>En unidades</span> </th>

                                </tr>";
        $index = 0;
        while($index < count($commentsList)){
            $val = $commentsList[$index];
            if($index == $first_id){
                $auxTable .= "<tr>
                                    <td class='first'>".$val[0]."</td>
                                    <td class='value first'><img src='images/bar.png' alt='' width='". self::calculatedWidth($last, $first, $val[1])."' height='16' />".$val[1]."</td>
                                </tr>";
            }else{
                if($index == (count($commentsList)-1)){
                                 $auxTable .= "<tr>
                                    <td>".$val[0]."</td>

                                    <td class='value last'><img src='images/bar.png' alt='' width='". self::calculatedWidth($last, $first, $val[1])."' height='16' />".$val[1]."</td>
                                </tr>";
                }else{
                                 $auxTable .= "<tr>
                                    <td>".$val[0]."</td>

                                    <td class='value'><img src='images/bar.png' alt='' width='". self::calculatedWidth($last, $first, $val[1])."' height='16' />".$val[1]."</td>
                                </tr>";
                }
            }
            $index++;
        }
        $auxTable .= " </table>";
        return $auxTable;

    }

    public static function calculatedWidth($min, $max, $value){
        $min_width = 10;
        $max_width = 290;
        if($value == $min){
            return $min_width;
        }
        if($value == $max){
            return $max_width;
        }
        $percent = ($value * 100) / $max;
        return ($max_width * $percent) / 100;
    }

    public static function getCommentsCountByAuthor($requiered = true, $admin = false){
        if ($requiered) {
            if (!$admin) {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
            } else {
                require_once '../../persistencia/dBase.php';
                require_once '../../persistencia/persistencia.php';
                require_once '../../persistencia/laligadel5DBase.php';
            }
        }


        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia('select');

        $per->addColum('nombre');
        $per->addColum('COUNT( id )');
        $per->setTable("comments");
        $per->addGroupBy('nombre');
        $per->addOrderBy('nombre');
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();

        while ($index + 2 <= count($auxDatos)) {
            $data = array();
            array_push($data, $auxDatos[$index]);
            array_push($data, $auxDatos[$index + 1]);
            array_push($list, $data);
            $index = $index + 2;
        }
        return $list;
    }
}

