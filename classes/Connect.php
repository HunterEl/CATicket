<?php
	
	class Connect {

		private $db_connection = null;
		public $errors = array();
		
		public function __construct() {
			$_SESSION['login_status'] = 0;
		}

		function login($usr, $pwd) {

			if (empty($_GET['username'])) {
				$this->errors[] = "Username field is empty!";
			}
			if (empty($_GET['password'])) {
				$this->errors[] = "Password field is empty!";
			}
			else {

				// Create connection to database
	$db = new mysqli('localhost','peacockjs','joejose1997','admin');
				// Prevent injection
				$username = $db->real_escape_string($usr);
				$password = $db->real_escape_string($pwd);

				if (!$db->connect_errno) {
				echo "pre-query";

					 $sql = "SELECT Email, password
                        FROM SysAdmin
                        WHERE Email = '" . $username . "';";

                    $query_result = $db->query($sql);
			echo "got result";
                    if ($query_result->num_rows == 1) {
                    	$row = $query_result->fetch_assoc();
			echo "<b/>".$row['password']."  ".$row['Email'];
                    	if ($password ==  $row['password'] && 
                    		$username == $row['Email'])
{
							$_SESSION['login_status'] = 1;	
							$_SESSION['username'] = $row['Email']; //added by hunter on 5/3/15
			echo "session login status == 1";
                    	}
             			else {
             				$this->errors[] = "Wrong Password!";
					echo "wrong password";
             			}
                    }
                    else {
                    	$this->errors[] = "Username does not exist.";
			echo "wrong username";
                    }
				}
			}	

		}

		function logout() {
			$_SESSION[] = array(); // set to an empty array to remove all contents from the var
			session_destroy();
		}

		function loggedIn() {
			echo "<br/> loggedIn()";
			if ($_SESSION['login_status'] == 1) {
				return True;
			}
			else {
				return False;
			}
		}
	}
	
	
	
?>
