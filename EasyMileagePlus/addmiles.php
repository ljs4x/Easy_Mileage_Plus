<?php 

//define all variable names
$user_ID = $response = $selected_vehicle = $add_date = $add_miles = '';

//set userID using cookie
$cookie = "loggedInUser";
if(isset($_COOKIE[$cookie])){
	$cookie_value = $_COOKIE[$cookie];
	$user_ID = $cookie_value;
}

//setup the vehicle dropdown selector
$vehicle_array = array();
include('conn_proc.php');
include('sql/populateVehicle.php');
$vehicle_array = populateVehicle($connection, $vehicle_array, $user_ID);
$first_ID = key($vehicle_array);
$connection -> close();

//handle the vehilcle drop down if it's blank. 
if(!$vehicle_array) {
	$response = "Vehicle list was not found. 
		Please make sure a vehicle is added to your account on the account page.";
}

//check for incoming data
$action = filter_input(INPUT_POST, 'action');

//THIS ONLY HAPPENS IF THEY'VE FILLED OUT THE FORM
if (isset($action)) {
	
	//define variable names
	$vehicle_id = $add_date = $add_miles = '';
	
	//load form data
	$vehicle_id = filter_input(INPUT_POST, 'selected_vehicle');
	$add_date = filter_input(INPUT_POST, 'inputDate');
	$add_miles = filter_input(INPUT_POST, 'milesInput');
	
	//validate miles is a usable number.
	if(filter_var($add_miles, FILTER_VALIDATE_INT) === false || $add_miles <= 0) {
    	$response = "Miles must be a whole number greater than 0";
	} 

// Add miles if no "response" message indicating error
	if(!$response) {
		include('conn_proc.php');
		
		$query = "INSERT INTO Miles (User_ID, Vehicle_ID, Mile_date, Mile_count) 
			VALUES('$user_ID', '$vehicle_id', '$add_date', '$add_miles')";
		$insertMilesStatement = $connection->prepare($query);
		if ($insertMilesStatement->execute()) {
		    $response =  "Record has been successfully added!";
		} else {
		    $response = "Error: The record not added. Please try again.";
		}
		$connection->close();
	}
}
include('addmilesform.php');