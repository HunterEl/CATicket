<?php

$name = $_POST['name'];
$password = $_POST['password'];

if((!isset($name)) || (!isset($password))){
  //visitor needs to enter a name and password

?>

  <h1>Please log in</h1>
  <form method="post" action="AdminLogin.php">
  <p>Username: <input type="text" name="name"></p>
  <p>Password: <input type="text" name="password"></p>
  <p><input type="submit" name="submit" value="Log in"></p>
  </form>

  </form>
} else{
  //connect to mysql
 //fill in both with you username and password variables with your 
 // server credentials 
  $mysql = mysqli_connect("localhost", $username, $password);
  if(!$mysql){
  echo 'Cannot connect to database.';
  exit;
  }
  //select the appropriate database
  $selected = mysqli_select_db($mysql, "SysAdmin");
  if(!$selected){
  echo "cannot select database.";
  exit;
  }

  //query the database for a match
  $query = "select count(*) from SysAdmin where Email = '".$name"' and password = sha1('".$password."')";
  $result = mysqli_query($mysql, $query);
  if(!$result){
  echo "cannot run query";
  exit;
  }
  $row = mysqli_fetch_row($result);
  $count = $row[0];

  if($count > 0){
  echo "<h1>Here it is!</h1>
        <p> secret loging page</p>
  ";
  }
else{
echo "<h1>NOPE</h1>";
<p>No login for you</p>
}
}
?>