<?php
session_start ();
if($_POST["myusername"] != "" && $_POST["mypassword"] != ""){ 
	require_once("../logica/manageUserLogued.class.php");
	$manager = new manageUserLogued();
	$found = $manager->checkAdminUser($_POST["myusername"],$_POST["mypassword"]);
	if($found){
		$_SESSION['userAdmin'] = $found;
		//echo "aca";
		header("location:index.php");
	}else{
		header("location:error.php");
	}
}