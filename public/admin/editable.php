<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli('localhost', 'peacockjs', 'joejose1997', 'admin');

//check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$param = $_GET['id'];

$result = $conn->query("SELECT cName, Email, Phone, Contact, UC.Admin, UC.Manager, O_Name, Location, status FROM User_Contact AS UC, CAccounts AS CA WHERE CID = "$param" AND ID ="$param" ");

$outp = ""; 


while($rs = $result->fetch_array(MYSQLI_ASSOC)){
	if ($outp != "") {$outp .= ",";}
	$outp .= '{"cName":"'  . $rs["cName"] . '",';
    $outp .= '"Email":"'   . $rs["Email"]. '",';
    $outp .= '"Phone":"'  . $rs["Phone"] . '",';
    $outp .= '"Admin":"'   . $rs["Admin"]. '",';
    $outp .= '"Manager":"'  . $rs["Manager"] . '",';
    $outp .= '"O_Name":"'   . $rs["O_Name"]. '",';
    $outp .= '"Location":"'  . $rs["Location"] . '",';
    $outp .= '"status":"'. $rs["status"]     . '"}'; 
}

$outp = '{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>