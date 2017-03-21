<?php

//connection
include('conn_proc.php');

$user_ID = '';
//COOKIE WORK
$cookie = "loggedInUser";
if(isset($_COOKIE[$cookie])){
	$cookie_value = $_COOKIE[$cookie];
	$user_ID = $cookie_value;
}



$response = array();

//get action variable from POST
$action = filter_input(INPUT_POST, 'action');
switch($action) {
    case 'Add Vehicle':
    	
    	
        
        $new_vehicle_make = filter_input(INPUT_POST, 'make');
        $new_vehicle_model = filter_input(INPUT_POST, 'model');
        $new_vehicle_year = filter_input(INPUT_POST, 'year');
        
        
        //if we implement this checkbox than we need another 
        //SQL statement to go through and set all other cars associated 
        //with user to not be the default prior to setting the new car as the default.
        $new_vehicle_default = $_POST['default'];
        if($new_vehicle_default == 1) {
        	$query = "UPDATE Vehicles SET Vehicle_default = 0  WHERE User_ID = '$user_ID'";
        	$resetDefaultVehiclesQuery = $connection -> prepare($query);
        	if($resetDefaultVehiclesQuery -> execute()) {
        		array_push($response, "Vehicle defaults reset query fired.");
        	}
        	else {
        		array_push($response, "Vehicle defaults reset query did not fire, problem?");
        	}
        	
        }
        //ensure that the default setting is set correctly.
        else {
        	$new_vehicle_default = 0;
        }
        
        $new_vehicle_license = filter_input(INPUT_POST, 'license_plate_number');

        $query = "INSERT INTO Vehicles (User_ID, Vehicle_make, Vehicle_model, Vehicle_year, Vehicle_default, Vehicle_lic_number) VALUES ('$user_ID', '$new_vehicle_make', '$new_vehicle_model', '$new_vehicle_year', '$new_vehicle_default', '$new_vehicle_license')";
		$insertVehicleStatement = $connection->prepare($query);
		
		if ($insertVehicleStatement->execute()) {
		    array_push($response, "Record has been successfully added!");
		} else {
		    array_push($response, "Error: The record was not added. Please try again.");
		}
		break;
	
	case 'Delete Vehicle':
		
		
		
	    $vehicle_ID = filter_input(INPUT_POST, 'selected_vehicle');
	    
	    //DELETE from miles first to protect integrity
	    $query = "DELETE FROM Miles WHERE Vehicle_ID = ?";
	    $deleteMilesStatement = $connection -> prepare($query);
	    $deleteMilesStatement -> bind_param('i', $vehicle_ID);
	    if($deleteMilesStatement -> execute()) {
	        array_push($response, "Miles records deleted as well.");
	    } else {
	        array_push($response, "Miles records were not affected.");
	    }
	    $deleteMilesStatement -> free_result();
	    
	    //Then delete the vehicle from vehicle
	    $query = "DELETE FROM Vehicles WHERE Vehicle_ID = ? AND User_ID = ?";
	    $deleteVehicleStatement = $connection->prepare($query);
	    $deleteVehicleStatement -> bind_param('ii', $vehicle_ID, $user_ID);

	    if ($deleteVehicleStatement->execute()) {
		    array_push($response, "Record has been successfully deleted!");
		} else {
		    array_push($response, "Error: The record was not deleted. Please try again.");
		}
		break;
	
	case 'Change Password':
		
		
		
        $password_entered = filter_input(INPUT_POST, 'password');
        $password_new = filter_input(INPUT_POST, 'password_new');
        $password_new_repeat= filter_input(INPUT_POST, 'password_new_repeat');
        
        if($password_new != $password_new_repeat) {
        	array_push($response, "Please verify new password fields match.");
        	break;
        }
      	$user_password_from_query_array = array();
	// If password is validated prepare statement
		$statement =  $connection->prepare ("SELECT User_password 
		FROM Users WHERE User_ID = ?");
		
	// Bind statement, execute then store to an array
		$statement->bind_param('i', $user_ID);
	    if($statement->execute()) {
	    	$statement -> bind_result($user_pass);
		    $statement->store_result();
		    while($statement -> fetch()) {
				array_push($user_password_from_query_array, $user_pass);
			}
			$statement -> free_result();
			$encrypted_password = $user_password_from_query_array[0];
			$password = password_verify($password_entered, $encrypted_password);
			
			//check to make sure we only got one password back from the query to
			//protect against data anomalies.  If we got one result back than they 
			//entered their original password correctly.
	        if(count($user_password_from_query_array) == 1 && $password == true) {
	        	$new_encrypted_password = password_hash($password_new, PASSWORD_DEFAULT);
	        	$update_pass_statement = $connection->prepare ("UPDATE Users SET User_password = ? WHERE User_ID = ?");
	        	$update_pass_statement -> bind_param('si', $new_encrypted_password, $user_ID);
	        	if($update_pass_statement -> execute()) {
	        		array_push($response, "User password UPDATE query completed!!");
	        	} else {
	        		array_push($response, "User password UPDATE query didn't fire.");
	        	}
	        } else {
	        	array_push($response, "User password verification query returned more than 1 row. Data anomaly?");
	        }
	    } else {
	    	array_push($response, "User password verification query didn't fire.");
	    }
	    break;
	
	case 'Change Email':
		
        $email_new = filter_input(INPUT_POST, 'email_new');
        $email_new_repeat= filter_input(INPUT_POST, 'email_new_repeat');
	    $password_entered = filter_input(INPUT_POST, 'password');
	    
	    if (!filter_var($email_new, FILTER_VALIDATE_EMAIL)) {
			array_push($response, "Invalid email format. Please try again.");
			break;
		} 
	    if ($email_new != $email_new_repeat) {
        	array_push($response, "Please verify new email fields match.");
        	break;
        }
      
        $user_password_from_query_array = array();
		// If password is validated prepare statement
		$statement =  $connection->prepare ("SELECT User_password 
		FROM Users WHERE User_ID = ?");
	
	// Bind statement, execute then store to an array
		$statement->bind_param('i', $user_ID);
	    if($statement->execute()) {
	    	$statement -> bind_result($user_pass);
		    $statement->store_result();
		    while($statement -> fetch()) {
				array_push($user_password_from_query_array, $user_pass);
			}
			$statement -> free_result();
			$encrypted_password = $user_password_from_query_array[0];
			$password = password_verify($password_entered, $encrypted_password);
			
			if(count($user_password_from_query_array) == 1 && $password == true) {
				$update_email_statement = $connection->prepare ("UPDATE Users SET User_email = ? WHERE User_ID = ?");
	        	$update_email_statement -> bind_param('si', $email_new, $user_ID);
	        	if($update_email_statement -> execute()) {
	        		array_push($response, "User email UPDATE query completed!!");
	        		$connection -> close();
	        	} else {
	        		array_push($response, "User email UPDATE query didn't fire.");
	        	}
			} else {
				array_push($response, "User password entered incorrectly.");
			}
	    } else {
	    	array_push($response, "User password verification query didn't fire.");
	    }
	    break;
}

//This function gets called here, so that the dropdown has the correct cars in it after 
//the queries modify the number of cars.
//THIS WHOLE MESS CAN BE IT's OWN FUNCTION**************************************
$vehicle_array = array();
include("sql/populateVehicle.php");
$vehicle_array = populateVehicle($connection, $vehicle_array, $user_ID);

// request handing for vehicle array. If array is null or blank. 
if(!$vehicle_array) {
	array_push($response, "Vehicle list was not found. 
		Please make sure a vehicle is added to your account or try again.");
}
$first_ID = key($vehicle_array);


include 'accountform.php';

?>