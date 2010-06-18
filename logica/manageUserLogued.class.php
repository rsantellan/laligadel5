<?php

class manageUserLogued {
	
	public function checkAdminUser($user,$pass){
		include('../persistencia/dBase.php');
		require_once '../persistencia/laligadel5DBase.php';
		include('../persistencia/persistencia.php');
                
		$conn = new DBase ( laligadel5DBase::$host, laligadel5DBase::$user, laligadel5DBase::$pass );
		$conn->selectDB ( laligadel5DBase::$database );
		
		$user = stripslashes($user);
		$user = mysql_real_escape_string($user);
		
		$pass = stripslashes($pass);
		$pass = mysql_real_escape_string($pass);
		$pass = md5($pass);
		$per = new Persistencia ( 'select' );
		
		$per->addColum ( "*" );
		
		$per->addWhere ( "pass='$pass'" );
		$per->addWhere ( "user='$user'" );
		$per->setTable ( "users" );
		$str = $per->constructQuery ();
		$result = $per->doQuery ( $str );
		
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		if($count==1){
			
			session_register("userAdmin");
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function checkUser($email){
		include('../persistencia/dBase.php');
		include('../persistencia/thetaDBase.php');
		include('../persistencia/persistencia.php');
		$conn = new DBase ( thetaDBase::$host, thetaDBase::$user, thetaDBase::$pass );
		$conn->selectDB ( thetaDBase::$database );
		
		$email = stripslashes($email);
		$email = mysql_real_escape_string($email);
		
		$per = new Persistencia ( 'select' );
		
		$per->addColum ( "*" );
		$per->addWhere ( "mail='$email'" );
		$per->setTable ( "mailing" );
		$str = $per->constructQuery ();
		$result = $per->doQuery ( $str );
		
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		if($count==1){
			// 	Register $myusername, $mypassword and redirect to file "login_success.php"
			session_register("myusername");
			$per->viewData($result);
			$auxDatos = $per->returnValores();
			
			//Guardo el tiempo en el que el usuario se logueo.
			$per1 = new Persistencia ( "INSERT" );
			$per1->setTable("list_logued_users");
			$per1->addColum ( 'userId' );
			
			$per1->addValue ( "'".$auxDatos[0]."'" );
	
			$str = $per1->constructQuery ();
			$result = $per1->doQuery ( $str );
			return $auxDatos[0];
		}
		else {
			return '';
		}
	}
}
