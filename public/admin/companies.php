<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli('localhost', 'peacockjs', 'joejose1997', 'admin');

//check for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT ID, O_Name, Location FROM CAccounts");

$outp = ""; 

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"ID":"'  . $rs["ID"] . '",';
    $outp .= '"O_Name":"'   . $rs["O_Name"]. '",';
    $outp .= '"Location":"'. $rs["Location"]     . '"}'; 
}
$outp = '{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>