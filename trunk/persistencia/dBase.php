<?php
if ((int)phpversion() < 5) die("Esta clase fue escrita para php5.");
class DBase{
	const VERSION="0.1";
	public $conn;
	
	//public function __construct($servername,$username,$password, $database){
		
	public function __construct($servername,$username,$password){
		try{
			$conn=$this->connect($servername,$username,$password);
			//$this->createDB($database,$conn);
		}catch (Exception $e){
			echo "No se ha podido conectar a la base de datos. El error es: ". $e;
		}
	}
	
	private function connect($servername,$username,$password){
		return mysql_connect($servername,$username,$password);
	}
	
	private function createDB($database,$conn){
		try{
			mysql_query("CREATE DATABASE $database", $conn);
		}catch(Exception $e){
			echo "No se ha podido crear la base de datos $database. ". "El error es: ". $e;
		}
	}
	
	public function selectDB($database){
		mysql_select_db($database);
	}
	
	public function getDataSimple($result,$nombre){
		while ($row=mysql_fetch_array($result)){
				$data[]=$row[$nombre];
		}
		return $data;
	}
}



