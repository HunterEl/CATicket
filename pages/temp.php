<?php
	error_reporting(E_ALL);
	ob_start();	
	session_save_path('../sessions');
	session_start(); //taint
	echo "after start";

	ini_set('session.gc_probability', 1);
	echo " after ini set";
	require_once("../classes/Connect.php");
	echo "checking for first req";
	require_once("../config/db_config.php");
        echo "even more before";
	echo "before";
	echo "butts";
	echo "dicks";
	$connector = new Connect();
	echo "hey";
	if (isset($_GET['login'])) {
		echo "hey2";
		$username = $_GET['username'];
		$password = $_GET['password'];
		$connector->login($username, $password);
	echo "nope";
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
