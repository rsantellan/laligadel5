<?php

class Image {

    private $id;
    private $name;
    private $type;
    private $rank;
    private $file;
    private $ownUser;
    private $visible;
    private $categoryId;

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        return $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        return $this->name = $name;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        return $this->type = $type;
    }

    public function getRank() {
        return $this->rank;
    }

    public function setRank($rank) {
        return $this->rank = $rank;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        return $this->file = $file;
    }

    public function getOwnUser() {
        return $this->ownUser;
    }

    public function setOwnUser($ownUser) {
        return $this->ownUser = $ownUser;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible) {
        return $this->visible = $visible;
    }

    public function __toString() {
        return 'Imagen:' . $this->getName();
    }

    private $requiere = false;
    private $imageActive = false;
    private $requiereInclude = false;

    private function addRequiered() {
        if (!$this->requiere) {
            require_once './persistencia/dBase.php';
            require_once './persistencia/persistencia.php';
            require_once './persistencia/laligadel5DBase.php';
            $this->requiere = true;
        }
    }

    private function addIncludeRequiere() {
        if (!$this->requiereInclude) {
            include('../persistencia/dBase.php');
            include('../persistencia/laligadel5DBase.php');
            include('../persistencia/persistencia.php');
            $this->requiereInclude = true;
        }
    }

    public function retrieveByPk($id) {
        //$this->addRequiered();
        $this->addIncludeRequiere();
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per = new Persistencia('select');

        $per->addColum("*");
        $per->addWhere("id='$id'");
        $per->setTable("images");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);

        if (!$result)
            return null;
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $image = new Image();
        $image->setId($auxDatos[0]);
        $image->setName($auxDatos[1]);
        $image->setType($auxDatos[2]);
        $image->setRank($auxDatos[3]);
        $image->setFile($auxDatos[4]);
        $image->setOwnUser($auxDatos[5]);
        $image->setVisible($auxDatos[6]);
        return $image;
    }

    public function changeRating($number) {
        $value = $this->getRank() + $number;
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia("UPDATE");
        $per->setTable("images");
        $per->addColum('rating');
        $per->addValue($value);
        $per->addWhere('id=' . $this->getId());
        $str = $per->constructQuery();

        $result = $per->doQuery($str);
        return true;
    }

    public function changeVisibility() {
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per = new Persistencia("UPDATE");
        $per->setTable("images");
        $per->addColum('visible');
        $per->addValue(!$this->getVisible());
        $per->addWhere('id=' . $this->getId());
        $str = $per->constructQuery();

        $result = $per->doQuery($str);
        return true;
    }

    public function save() {
        $this->addIncludeRequiere();
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per1 = new Persistencia("INSERT");
        $per1->setTable("images_laliga");
        $per1->addColum('name');
        $per1->addColum('type');
        $per1->addColum('rating');
        $per1->addColum('file');
        $per1->addColum('ownuser');

        $per1->addValue("'" . $this->getName() . "'");
        $per1->addValue("'" . $this->getType() . "'");
        $per1->addValue("'" . $this->getRank() . "'");
        $per1->addValue("'" . $this->getFile() . "'");
        $per1->addValue("'" . $this->getOwnUser() . "'");

        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        return true;
    }

    public static function saveImage($required, $admin, $name, $file, $type = "", $rank = 0, $ownUser = "") {
        if ($required) {
            if (!$admin) {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
            } else {
                require_once '../persistencia/dBase.php';
                require_once '../persistencia/persistencia.php';
                require_once '../persistencia/laligadel5DBase.php';
            }
        }
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);
        $per1 = new Persistencia("INSERT");
        $per1->setTable("images_laliga");
        $per1->addColum('name');
        $per1->addColum('type');
        $per1->addColum('rating');
        $per1->addColum('file');
        $per1->addColum('ownuser');

        $per1->addValue("'" . $name . "'");
        $per1->addValue("'" . $type . "'");
        $per1->addValue("'" . $rank . "'");
        $per1->addValue("'" . $file . "'");
        $per1->addValue("'" . $ownUser . "'");

        $str = $per1->constructQuery();
        $result = $per1->doQuery($str);
        return true;
    }

    public static function getAllWithoutCategory($required, $admin) {
        if ($required) {
            if (!$admin) {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
            } else {
                require_once '../persistencia/dBase.php';
                require_once '../persistencia/persistencia.php';
                require_once '../persistencia/laligadel5DBase.php';
            }
        }
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per = new Persistencia('select');
        $per->addColum("*");
        $per->addWhere("categoryId = 0");
        $per->setTable("images_laliga");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();

        while ($index + 8 <= count($auxDatos)) {
            $image = new Image();
            $image->setId($auxDatos[$index]);
            $image->setName($auxDatos[$index + 1]);
            $image->setType($auxDatos[$index + 2]);
            $image->setRank($auxDatos[$index + 3]);
            $image->setFile($auxDatos[$index + 4]);
            $image->setOwnUser($auxDatos[$index + 5]);
            $image->setVisible($auxDatos[$index + 6]);
            $image->setCategoryId($auxDatos[$index + 7]);
            array_push($list, $image);
            $index = $index + 8;
        }
        return $list;
    }

    public static function getAllOfCategory($categoryId, $required, $admin) {
        if ($required) {
            if (!$admin) {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
            } else {
                require_once '../persistencia/dBase.php';
                require_once '../persistencia/persistencia.php';
                require_once '../persistencia/laligadel5DBase.php';
            }
        }
        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per = new Persistencia('select');
        $per->addColum("*");
        $per->addWhere("categoryId = " . $categoryId);
        $per->setTable("images_laliga");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $index = 0;
        $list = array();

        while ($index + 8 <= count($auxDatos)) {
            $image = new Image();
            $image->setId($auxDatos[$index]);
            $image->setName($auxDatos[$index + 1]);
            $image->setType($auxDatos[$index + 2]);
            $image->setRank($auxDatos[$index + 3]);
            $image->setFile($auxDatos[$index + 4]);
            $image->setOwnUser($auxDatos[$index + 5]);
            $image->setVisible($auxDatos[$index + 6]);
            $image->setCategoryId($auxDatos[$index + 7]);
            array_push($list, $image);
            $index = $index + 8;
        }
        return $list;
    }

    public static function retrieveById($id, $requiered = false, $admin = false, $ajax = false) {

        if ($requiered) {
            if (!$admin) {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
            } else {
                if (!$ajax) {
                    require_once '../persistencia/dBase.php';
                    require_once '../persistencia/persistencia.php';
                    require_once '../persistencia/laligadel5DBase.php';
                } else {
                    require_once '../../persistencia/dBase.php';
                    require_once '../../persistencia/persistencia.php';
                    require_once '../../persistencia/laligadel5DBase.php';
                }
            }
        }

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per = new Persistencia('select');

        $per->addColum("*");
        $per->addWhere("id='$id'");
        $per->setTable("images_laliga");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);

        if (!$result)
            return null;
        $per->viewData($result);
        $auxDatos = $per->returnValores();
        $image = new Image();
        $image->setId($auxDatos[0]);
        $image->setName($auxDatos[1]);
        $image->setType($auxDatos[2]);
        $image->setRank($auxDatos[3]);
        $image->setFile($auxDatos[4]);
        $image->setOwnUser($auxDatos[5]);
        $image->setVisible($auxDatos[6]);
        $image->setCategoryId($auxDatos[7]);
        return $image;
    }

    /**
     *
     * @param int $imageId
     * @param int $categoryId
     * @param boolean $required
     * @param boolean $admin
     * @return Image the changed image
     */
    public static function addImageToCategory($imageId, $categoryId, $required, $admin = false) {
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

        try {
            $image = self::retrieveById($imageId);
        } catch (Exception $e) {
            return false;
        }

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per = new Persistencia('update');
        $per->addColum('categoryId');
        $per->addValue($categoryId);
        $per->addWhere("id = " . $imageId);
        $per->setTable("images_laliga");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        return $image;
    }

    public static function removeImage($imageId, $required, $admin = false, $imageHandler = false, $ajax = false) {
        if ($required) {
            if (!$admin) {
                require_once './persistencia/dBase.php';
                require_once './persistencia/persistencia.php';
                require_once './persistencia/laligadel5DBase.php';
                if ($imageHandler) {
                    require_once './ImageHandler.class.php';
                }
            } else {

                if ($ajax) {
                    require_once '../../persistencia/dBase.php';
                    require_once '../../persistencia/persistencia.php';
                    require_once '../../persistencia/laligadel5DBase.php';
                    if ($imageHandler) {
                        require_once '../../logica/ImageHandler.class.php';
                    }
                } else {
                    require_once '../persistencia/dBase.php';
                    require_once '../persistencia/persistencia.php';
                    require_once '../persistencia/laligadel5DBase.php';
                    if ($imageHandler) {
                        require_once '../ImageHandler.class.php';
                    }
                }
            }
        }

        try {
            $image = self::retrieveById($imageId);

            $imageHandler = new ImageHandler();
            $realPath = getcwd();
            $returnPath = "";
            if ($admin) {
                if ($ajax) {
                    $realPath .= "/../../";
                    $returnPath = "../../";
                } else {
                    $realPath .= "/../";
                    $returnPath = "../";
                }
            } else {
                $realPath .= "/";
            }
            $originalFile = $realPath . $image->getFile();
            $imageHandler->removeCompleteImage($originalFile);
        } catch (Exception $e) {
            print_r($e->getMessage());
            return false;
        }

        $conn = new DBase(laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass);
        $conn->selectDB(laligadel5DBase::$database);

        $per = new Persistencia('delete');
        $per->addWhere("id = " . $imageId);
        $per->setTable("images_laliga");
        $str = $per->constructQuery();
        $result = $per->doQuery($str);
        return true;
    }

}
