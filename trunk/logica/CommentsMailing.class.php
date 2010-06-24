<?php

class CommentsMailing {
	
	private $id;
	private $email;
	private $active;
	
	
	public function setActive($active) {
		$this->active = $active;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getActive() {
		if($this->active == '1') return true;
		return false;
		//return $this->active;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getId() {
		return $this->id;
	}


	
	public static function getAllCommentsMailsAdmin() {
		require_once '../persistencia/dBase.php';
		require_once '../persistencia/persistencia.php';
		require_once '../persistencia/laligadel5DBase.php';
		$conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
		$conn->selectDB ( laligadel5DBase::$database );
		$per = new Persistencia ( 'select' );
		
		$per->addColum ( "*" );
		$per->setTable ( "comments_mailing" );
		$per->addOrderBy('email ASC');
		$str = $per->constructQuery ();
		$result = $per->doQuery ( $str );
		$per->viewData ( $result );
		$auxDatos = $per->returnValores ();
		$index = 0;
		$list = array ();
		while ( $index + 3 <= count ( $auxDatos ) ) {

			$commentMail = new CommentsMailing();
			$commentMail->setId($auxDatos [$index]);
			$commentMail->setEmail($auxDatos [$index+1]);
			$commentMail->setActive($auxDatos [$index+2]);
			array_push ( $list, $commentMail);
			$index = $index + 3;
		}

		return $list;
	}
	
	public static function getArrayAllMails() {
		require_once './persistencia/dBase.php';
		require_once './persistencia/persistencia.php';
		require_once './persistencia/laligadel5DBase.php';
		$conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
		$conn->selectDB ( laligadel5DBase::$database );
		$per = new Persistencia ( 'select' );
		
		$per->addColum ( "email" );
		$per->setTable ( "comments_mailing" );
		$str = $per->constructQuery ();
		$result = $per->doQuery ( $str );
		$per->viewData ( $result );
		$auxDatos = $per->returnValores ();
		$index = 0;
		$list = array ();
		while ( $index < count ( $auxDatos ) ) {
			array_push ( $list, $auxDatos [$index] );
			$index++;
		}
		return $list;
	}
	
	public static function addEmail($email){
		require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );

        $per1 = new Persistencia ( "INSERT" );
        $per1->setTable("comments_mailing");
        $per1->addColum ( 'email' );

        $per1->addValue ( "'".$email."'" );

        $str = $per1->constructQuery ();
        $result = $per1->doQuery ( $str );
        return true;
	}

	public static function addBulkEmail($emailList){
		require_once './persistencia/dBase.php';
        require_once './persistencia/persistencia.php';
        require_once './persistencia/laligadel5DBase.php';

        $conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
        $conn->selectDB ( laligadel5DBase::$database );

        foreach($emailList as $email){
        	$per1 = new Persistencia ( "INSERT" );
	        $per1->setTable("comments_mailing");
	        $per1->addColum ( 'email' );
	
	        $per1->addValue ( "'".$email."'" );
	
	        $str = $per1->constructQuery ();
	        $result = $per1->doQuery ( $str );
        }
        return true;
	}
}
