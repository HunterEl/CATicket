<!DOCTYPE html>
<html >


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
if (isset($_GET['O_Name'])) 
	{ $O_N=$db->real_escape_string(trim($_GET['O_Name'])); }
else 
	{ $O_N = ''; }
if (isset($_GET['Loc'])) 
	{ $loc=$db->real_escape_string(trim($_GET['Loc'])); }
else 
	{ $loc = ''; }
if (isset($_GET['Stat'])) 
	{ $stat=$db->real_escape_string(trim($_GET['Stat'])); }
else 
	{ $stat = ''; }


$q1 = "select * from CAccounts where id=".$ID.";";
$res1 = $db->query($q1);
$row1 = $res1->fetch_assoc();

$uq = "update CAccounts set O_Name='".$O_N."', Location='".$Loc."', Status='".$Stat."' where ID = ".$ID.";";


$q2 = "select * from User_Contact where (User_Contact.cid = ".$row1['Admin']." or User_Contact.cid = ".$row1['Manager']." or User_Contact.cid in (select CID from Contact where AID = ".$row1['ID']."));";
$res2 = $db->query($q2);
for ($i=0;$i<$res2->num_rows;$i++)
{
	$row2 = $res2->fetch_assoc();
if (isset($_GET['name'.$i])) 
	{ $name=$db->real_escape_string(trim($_GET['name'.$i])); }
else 
	{ $name = ''; }
if (isset($_GET['email'.$i])) 
	{ $email=$db->real_escape_string(trim($_GET['email'.$i])); }
else 
	{ $email = ''; }
if (isset($_GET['phone'.$i])) 
	{ $phone=$db->real_escape_string(trim($_GET['phone'.$i])); }
else 
	{ $phone = ''; }
if (isset($_GET['admin'.$i])) 
	{ $admin=true; }
else 
	{ $admin = false; }
if (isset($_GET['Manager'.$i])) 
	{ $man=true; }
else 
	{ $man = false; }
if (isset($_GET['Contact'.$i])) 
	{ $con=true; }
else 
	{ $con=false; }

$uq = "update User_Contact set cName = '".$name."', Email = '".$email."', Phone = '".$phone."', Admin = '".$admin."', Manager = '".$man."', Contact = '".$con."' where CID = ".$row2['CID'].");";

if ($admin== true)
{
	$uq = "update CAccounts set Admin = ".$row2['CID']." where ID = ".$ID.";";
	$db->query($uq);
}
if ($man == true)
{
	$uq = "update CAccounts set Manager = ".$row2['CID']." where ID = ".$ID.";";
	$db->query($uq);
}
if ($con == true)
{
	$uq = "insert into Contact values (".$ID.", ".$row2['CID'].");";
	$db->query($uq);
}

}



header ("Location: view.php?id=".$id);


?>