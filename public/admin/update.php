<?php

$db = new mysqli('localhost', 'peacockjs', 'joejose1997', 'admin');
if (mysqli_connect_errno()) {
	echo 'Error: Could not connect';
	exit;
}

if (isset($_GET['id'])) 
	{ $ID=$db->real_escape_string(trim($_GET['id'])); }
else 
	{ $ID = ''; }

$q1 = "select * from CAccounts where id=".$ID.";";
$res1 = $db->query($q1);
$row1 = $res1->fetch_assoc();



//get the get variables from the url, sanitize them, and handle optional paramaters
if (isset($_GET['O_Name'])) 
	{ $org_name=$db->real_escape_string(trim($_GET['O_Name'])); }
else 
	{ $org_name = ''; }
if (isset($_GET['Loc'])) 
	{ $location = $db->real_escape_string(trim($_GET['Loc'])); }
else 
	{ $location = ''; }
if (isset($_GET['Stat'])) 
	{ $status = $db->real_escape_string(trim($_GET['Stat'])); }
else 
	{ $status = ''; }
if (isset($_GET['name'])) 
	{ $name = $db->real_escape_string(trim($_GET['name'])); }
else 
	{ $name = ''; }
if (isset($_GET['email'])) 
	{ $email = $db->real_escape_string(trim($_GET['email'])); }
else 
	{ $email = ''; }
if (isset($_GET['phone'])) 
	{ $phone = $db->real_escape_string(trim($_GET['phone'])); }
else 
	{ $phone = ''; }
if (isset($_GET['admin'])) 
	{ $admin = $db->real_escape_string(trim($_GET['admin'])); }
else 
	{ $admin = ''; }
if (isset($_GET['Manager'])) 
	{ $manager = $db->real_escape_string(trim($_GET['Manager'])); }
else 
	{ $manager = ''; }
if (isset($_GET['Contact'])) 
	{ $contact = $db->real_escape_string(trim($_GET['Contact'])); }
else 
	{ $contact = ''; }

$query1 = "UPDATE CAccounts set O_Name = '".$org_name."' AND set Location = '".$location."' AND set status = '".$status."' WHERE ID = '".$companyID."';";
// $query2 = 


?>
