<?php
	
	class Connect {

		private $db_connection = null;
		public $errors = array();
		
		public function __construct() {
			$_SESSION['login_status'] = 0;
		}

		function login($usr, $pwd) {
			if (empty($_POST['username'])) {
				$this->errors[] = "Username field is empty!";
			}
			if (empty($_POST['password'])) {
				$this->errors[] = "Password field is empty!";
			}
			else {
				// Create connection to database
				$this->db_connection = new mysqli(HOST_NAME,USERNAME,PASSWORD,DB_NAME);

				// Prevent injection
				$username = $this->db_connection->real_escape_string($usr);
				$password = $this->db_connection->real_escape_string($pwd);

				if (!$this->db_connection->connect_errno) {

					 $sql = "SELECT Email, password
                        FROM SysAdmin
                        WHERE Email = '" . $username . "';";

                    $query_result = $this->db_connection->query($sql);

                    if ($query_result->num_rows == 1) {
                    	$row = $query_result->fetch_object();
                    	if (password_verify($password, $row->password)) {
                    		$_SESSION['username'] = $row->username;
							$_SESSION['login_status'] = 1;
                    	}
             			else {
             				$this->errors[] = "Wrong Password!";
             			}
                    }
                    else {
                    	$this->errors[] = "Username does not exist.";
                    }
				}
			}	

		}

		function logout() {
			$_SESSION[] = array(); // set to an empty array to remove all contents from the var
			session_destroy();
		}

		function loggedIn() {
			if ($_SESSION['login_status'] == 1) {
				return True;
			}
			else {
				return False;
			}
		}
	}
	
	
	
?>