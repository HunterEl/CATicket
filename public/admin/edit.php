<!DOCTYPE html>
<html >


<?php
//error_reporting(-1);
$db = new mysqli('localhost', 'peacockjs', 'joejose1997', 'admin');
if (mysqli_connect_errno()) {
	echo 'Error: Could not connect';
	exit;
}

if (isset($_GET['id'])) 
	{ $ID=$db->real_escape_string(trim($_GET['id'])); }
else 
	{ $ID = ''; }
$update_url = "update.php?id=".$ID;
$np_url = "new_person.php?id=".$ID;
$view_url = "view.php?id=".$ID;

$q1 = "select * from CAccounts where id=".$ID.";";
$res1 = $db->query($q1);
$row1 = $res1->fetch_assoc();



?>

<body>
 
<div ng-app="myApp" ng-controller="customersCtrl">

<form method="GET" action=<?php echo $update_url; ?> onsubmit="if(!confirm('Each Ticket can only have ONE Admin and ONE Manager. If you choose to create a new Admin or Manager they will overwrite the one one. Are you sure you want to submit?')){return false;}">
<label for="query">Organization Name:</label>
    <input type="text" class="form-control" name="O_Name" value="<?php echo $row1['O_Name']; ?>"></br>
    <label for="query">Location:</label>
<input type="text" class="form-control" name="Loc" value="<?php echo $row1['Location']; ?>"></br>
    <label for="query">Status:</label>
<input type="text" class="form-control" name="Stat" value="<?php echo $row1['status']; ?>"></br>
</br></br>
<?php 

$q2 = "select * from User_Contact where (User_Contact.cid = ".$row1['Admin']." or User_Contact.cid = ".$row1['Manager']." or User_Contact.cid in (select CID from Contact where AID = ".$row1['ID']."));";
$res2 = $db->query($q2);
for ($i=0;$i<$res2->num_rows;$i++)
{
	$row2 = $res2->fetch_assoc();
	$admin = '';
	$man = '';
	$contact = '';
	if ($row2['Admin'] == 1) { $admin='checked'; }
	if ($row2['Manager'] == 1) { $man='checked'; }
	if ($row2['Contact'] == 1) { $contact='checked'; }

echo "
<label for='query'>Name:</label>
<input type='text' class='form-control' name='name".$i."' value='".$row2['cName']."'>
<label for='query'>Email:</label>
<input type='text' class='form-control' name='email".$i."' value='".$row2['Email']."'>
<label for='query'>Phone:</label>
<input type='text' class='form-control' name='phone".$i."' value='".$row2['Phone']."'>
<label for='query'>Assign Admin:</label>
<input type='checkbox' class='form-control' name='admin".$i."' ".$admin.">
<label for='query'>Assign Manager:</label>
<input type='checkbox' class='form-control' name='Manager".$i."' ".$man.">
<label for='query'>Assign Contact:</label>
<input type='checkbox' class='form-control' name='Contact".$i."' ".$contact.">
</br>
";
}
echo "<input type='hidden' class='form-control' name='id' value=".$ID." >";

echo "<button type='submit'>Submit Modifications</button></form>";
echo "<button><a href=".$view_url.">Back to View</a></button>";
echo "<h4>Caution! Each organization can only have one Admin and one Manager. Do not add a new Admin or Manager without removing the old one</h4>";
?>

<form method="GET" action=<?php echo $np_url; ?>>
<label for="query">Name:</label>
<input type="text" class="form-control" name="name">
<label for="query">Email:</label>
<input type="text" class="form-control" name="email">
<label for="query">Phone:</label>
<input type="text" class="form-control" name="phone">
<label for="query">Assign Admin:</label>
<input type="checkbox" class="form-control" name="admin" >
<label for="query">Assign Manager:</label>
<input type="checkbox" class="form-control" name="Manager">
<label for="query">Assign Contact:</label>
<input type="checkbox" class="form-control" name="Contact">

<input type="hidden" class="form-control" name="id" value=<?php echo $ID; ?> >
<button type='submit'>Submit</button>
</form>

</div>

