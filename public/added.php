<?php

@ $db = new mysqli('localhost', 'peacockjs', 'joejose1997', 'admin');
//check for failed connection
if (mysqli_connect_errno()) {
	echo 'Error: Could not connect';
	exit;
}
//get the get variables from the url, sanitize them, and handle optional paramaters
if (isset($_GET['site_name'])) 
	{ $site_name=$db->real_escape_string(trim($_GET['site_name'])); }
else 
	{ $site_name = ''; }
if (isset($_GET['location'])) 
	{ $location = $db->real_escape_string(trim($_GET['location'])); }
else 
	{ $location = ''; }
if (isset($_GET['comments'])) 
	{ $comments = $db->real_escape_string(trim($_GET['comments'])); }
else 
	{ $comments = ''; }
if (isset($_GET['contact_name'])) 
	{ $contact_name = $db->real_escape_string(trim($_GET['contact_name'])); }
else 
	{ $contact_name = ''; }
if (isset($_GET['phone'])) 
	{ $phone = $db->real_escape_string(trim($_GET['phone'])); }
else 
	{ $phone = ''; }
if (isset($_GET['email'])) 
	{ $email = $db->real_escape_string(trim($_GET['email'])); }
else 
	{ $email = ''; }

$query = "select max(id) as id from CAccounts";
$result = $db->query($query);
$row = $result->fetch_assoc();
$AID = $row['id'] + 1;
echo $AID;
$query = "select max(cid) as id from User_Contact";
$result->free();
$result = $db->query($query);
$row = $result->fetch_assoc();
$CID = $row['id'] + 1;
echo $CID;
$result->free();
//defaulting such that the initial contact is manager and admin. This can be changed.
$query = "insert into User_Contact Values ('".$CID."', '".$contact_name."', '".$email."', '".$phone."' ,1 ,1 ,1 );";
$db->query($query);
$query = "insert into CAccounts Values ('".$AID."', '".$CID."', '".$CID."', '".$site_name."', '".$location."', 'Pending');";
$db->query($query);
$query = "insert into Contact values (".$AID.", ".$CID.");";
$db->query($query);

mysqli_close(db); //close the opened db connection
//we should probably add a check to make sure there were no conflicts updating the db and then route to the next page accordingly
header("Location: success.html"); 
exit; // just to make sure the header redirects and then we GTFO
?>


