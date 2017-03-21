<?php

//test connection page
	include ('conn_proc.php');
	include ('sql/signupSql.php');

// Set Default values
	$response = '';
	$login = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = filter_input(INPUT_POST, 'email');
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$email = strtolower($email);
		$email = htmlspecialchars($email);
		$password = filter_input(INPUT_POST, 'password');
		$password_repeat = filter_input(INPUT_POST, 'password_repeat');

// Email and password input validation
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $response = "Invalid email format. Please try again."; 
		} 
	
		else if (empty($password) || empty($password_repeat)) {
			$response = "Please fill both password fields.";
		}
		
		else if ($password != $password_repeat) {
			$response = "The passwords do not match. Please try again";
		}
		
		else if (strlen($password) < 5){
			$response = "The password length has to be at least 5 characters";
		}
	
	// After validation run prepared statement to check if user email already exist
	// If exist ask user to try again if it doesn't, add user to DB
		else if(filter_var($email, FILTER_VALIDATE_EMAIL) && $password === $password_repeat){
			
			$num_rows = doesAccountExist($connection, $email);
			
			if ($num_rows > 0 ) {
				$response = "<strong>$email already exist in our database. Please try a different email</strong>";
			}
			else if ($num_rows == 0) { 
				$response = encryptPassword($connection, $password, $email);
				
			} else {
				$response = '<strong>We could not create your account please try again later!</strong>';
	
			}
			$connection->close();
		}
	}
	
	include 'signupform.php';

?>