<?php
    include("./conn_proc.php");
    
    function doesAccountExist($connection, $email){
    	$emailStatement = $connection->prepare("SELECT User_email FROM Users WHERE User_email = ?");
    	$emailStatement->bind_param('s', $email);
    	$emailStatement->execute();
    	$emailStatement->store_result();
    	$num_rows = $emailStatement->num_rows;
    	$emailStatement -> free_result();
    	return $num_rows;
    }
    
    function encryptPassword($connection, $password, $email){
        $encryptP = password_hash($password, PASSWORD_DEFAULT);
		$signUpStmt = $connection->prepare("INSERT INTO Users (User_email, User_password) VALUES (?, ?)");
		$signUpStmt->bind_param("ss", $email, $encryptP);
		$signUpStmt->execute();
		$login = true;
		$response = '<strong>Account Created! Please log in below.</strong>';
		$signUpStmt-> free_result();
		return $response;
    }
?>