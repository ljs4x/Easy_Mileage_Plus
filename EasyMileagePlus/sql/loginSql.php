<?php
    include ("./conn_proc.php");
    
    function authenticateLogin($connection, $email, $user_array){
        $statement =  $connection->prepare ("SELECT User_ID, User_password 
		FROM Users WHERE User_email = ?");
// Bind statement, execute then store then get number of rows
		$statement->bind_param('s', $email);
	    $statement->execute();
	    $statement -> bind_result($user_id, $encryptedP);
	    $statement->store_result();
	    while($statement -> fetch()) {
			array_push($user_array, $user_id);
			array_push($user_array, $encryptedP);
		}
		$statement -> free_result();
		return $user_array;
    }
?>