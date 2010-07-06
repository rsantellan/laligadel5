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
class Category {

    //put your code here
    private $id;
    private $name;
    private $visible;

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

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }

    /**
     *
     * @param boolean $requiered
     * @param boolean $admin
     * @return array <Category>
     */
    public static function getAllCategories($onlyVisible, $requiered = true, $admin = false) {
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
        $per->setTable("category");
        if($onlyVisible){
            $per->addWhere('visible = 1');
        }
        
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();
        while ($index + 3 <= count($auxDatos)) {
            $category = new Category();
            $category->setId($auxDatos[$index]);
            $category->setName($auxDatos[$index + 1]);
            $category->setVisible($auxDatos[$index + 2]);
            array_push($list, $category);
            $index = $index + 3;
        }
        return $list;
    }

    public static function saveCategory($name, $visible) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per1 = new Persistencia("INSERT");
        $per1->setTable("category");
        $per1->addColum('name');
        $per1->addColum('visible');
        $per1->addValue("'" . $name . "'");
        $per1->addValue($visible);
        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        $per = new Persistencia("SELECT");
        $per->addColum("id");
        $per->setTable("category");
        $per->addOrderBy("id DESC");
        $per->addLimit(0, 1);
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        return $auxDatos[0];
    }

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

     public static function makeVisible($id, $value) {

        require_once '../../persistencia/dBase.php';
        require_once '../../persistencia/persistencia.php';
        require_once '../../persistencia/laligadel5DBase.php';

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per1 = new Persistencia("UPDATE");
        $per1->setTable("category");
        $per1->addColum('visible');
        $per1->addValue($value);
        $per1->addWhere('id = '.$id);
        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        print_r($str);
        return true;
    }

}

