<?php
	session_start();
	echo $_SESSION['username'] . " Logged in! ";
?>

<form method="POST" action="temp.php">
	<p class='t18' style='text-align:left;'>
	<input id='logoutButton' class='button' type='submit' value='Log Out' name='logout'>
</form>
