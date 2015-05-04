<?php
	error_reporting(E_ALL);
	ob_start();	
	session_save_path('../sessions');
	session_start(); 

	ini_set('session.gc_probability', 1);
	require_once("../classes/Connect.php");
	require_once("../config/db_config.php");
	$connector = new Connect();
	if (isset($_GET['login'])) {
		$username = $_GET['username'];
		$password = $_GET['password'];
		$connector->login($username, $password);
	}

	

	if (isset($_GET['logout'])) {
		$connector->logout();
	}	

	if($connector->loggedIn() == True){
		header ("Location: loggedin_page.php");
		
	}
	else {
		include ("login_page.php");
		echo "login failed";
		if($connector->errors) {
				foreach ($connector->errors as $error) {
					echo $error . "\n";
				}
		}
	}


?>
