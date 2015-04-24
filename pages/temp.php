<?php
	
	/**
	*/
	// if (!isset($_SERVER['https']) || !$_SERVER['https']) {
	// 	$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	// 	header ('Location: ' . $url);
	// }require_once("config/db_config.php");

	require_once("classes/Connect.php");
	require_once("config/db_config.php");

	session_start();
	$connector = new Connect();

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$connector->login($username, $password);
	}

	// if (isset($_POST['register'])) {
	// 	header ('Location: http://localhost/~Jieyang/transportation/register_control.php');
	//}

	if (isset($_POST['logout'])) {
		$connector->logout();
	}	

	if($connector->loggedIn() == True){
		header ("Location: pages/loggedin_page.php");
		
	}
	else {
		include ("pages/login_page.php");

		if($connector->errors) {
				foreach ($connector->errors as $error) {
					echo $error . "\n";
				}
		}
	}


?>