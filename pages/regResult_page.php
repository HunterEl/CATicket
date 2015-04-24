<?php
	
	require ("../classes/Connect.php");
	require ("../config/db_config.php");

	session_start();
	if ($_SESSION['regResult'] == 1) {
		echo "Registration complete. Welcome!";
	}
	else {
		echo "Sorry, registration failed. Please go back and try again";
	}
	
?>

<form method="POST" action="../pages/loggedin_page.php">
	<p class='t18' style='text-align:left;'>
	<input id='continue' class='button' type='submit' value='Continue' name='continue'>
</form>

