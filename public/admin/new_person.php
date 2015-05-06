<!DOCTYPE html>
<html >


<?php
error_reporting(-1);
$db = new mysqli('localhost', 'peacockjs', 'joejose1997', 'admin');
if (mysqli_connect_errno()) {
	echo 'Error: Could not connect';
	exit;
}

if (isset($_GET['name'])) 
	{ $name=$db->real_escape_string(trim($_GET['name'])); }
else 
	{ $name = ''; }
if (isset($_GET['email'])) 
	{ $email=$db->real_escape_string(trim($_GET['email'])); }
else 
	{ $email = ''; }
if (isset($_GET['phone'])) 
	{ $phone=$db->real_escape_string(trim($_GET['phone'])); }
else 
	{ $phone = ''; }
if (isset($_GET['admin'])) 
	{ $admin=true; }
else 
	{ $admin = false; }
if (isset($_GET['Manager'])) 
	{ $man=true; }
else 
	{ $man = false; }
if (isset($_GET['Contact'])) 
	{ $con=true; }
else 
	{ $con = false; }
if (isset($_GET['id'])) 
	{ $id=$db->real_escape_string(trim($_GET['id'])); }
else 
	{ $id = ''; }


$query = "select max(cid) as id from User_Contact";
$result = $db->query($query);
$row = $result->fetch_assoc();
$CID = $row['id'] + 1;
$result->free();


$iq = "insert into User_Contact values (".$CID.", '".$name."', '".$email."', '".$phone."', '".$admin."', '".$man."', '".$con."');";
$db->query($iq);
if ($admin== true)
{
	$uq = "update CAccounts set Admin = ".$CID." where ID = ".$id.";";
	$db->query($uq);
}
if ($man == true)
{
	$uq = "update CAccounts set Manager = ".$CID." where ID = ".$id.";";
	$db->query($uq);
}
if ($con == true)
{
	$uq = "insert into Contact values (".$id.", ".$CID.");";
	$db->query($uq);
}

header ("Location: view.php?id=".$id);


?>