<?php

// set cookie name and test if cookie is set
// if set reroute users back to addmiles.php
$cookie = "loggedInUser";
	if(isset($_COOKIE[$cookie])){
		header("Location: addmiles.php");
	}
// test connection page
include ('conn_proc.php');
include ('sql/loginSql.php');
$response = '';

// if cookie is set redirect to addmiles

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = filter_input(INPUT_POST, 'email');
		$email = strtolower($email);
		$email = htmlspecialchars($email);
		$password = filter_input(INPUT_POST, 'password');

// Email and password input validation
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $response = "Invalid email format. Please try again."; 
	} 
	else{
		$user_array = array();
// If email and password is validated run authenticationLogin
		$user_array = authenticateLogin($connection, $email, $user_array);
		$encryptedP = $user_array[1];
		$password = password_verify($password, $encryptedP);
		
// If array length is 2 ID and password is correct
// set cookie with cookie name and allow it to exist for 2 hours
// also set cookie for entire site.
		if (count($user_array) == 2 && $password == true) {
			$login = true;
			$cookie_value = $user_array[0];
			setcookie($cookie, $cookie_value, time() + (2 * 60 * 60), "/");
			header("Location: addmiles.php");
			
		}
		else {
			$login = false;
			$response = "<strong>Login failed for $email !</strong>";
		}
	}
}

$connection -> close();
include 'loginform.php';

?>