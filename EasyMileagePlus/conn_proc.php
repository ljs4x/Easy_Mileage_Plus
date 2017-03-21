<?php
//Connect to the database
    $host = getenv('IP');
    $user = "lukeschwarz";                  	 //Your Cloud 9 username
    $pass = "";                                  //Remember, there is NO password by default!
    $db = "miles_driven";                        //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
// Create connection
    $connection = mysqli_connect($host, $user, $pass, $db, $port);
    
// Test Connection
	if (!$connection) {
    	die("Connection failed: " .mysqli_connect_error());
	}
?>