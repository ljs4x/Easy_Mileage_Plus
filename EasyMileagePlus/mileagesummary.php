<?php

include("conn_proc.php");
include("sql/mileageSummarySql.php");
$cookie = "loggedInUser";
$response = "";
$today = date("Y-m-d");

// function to check if date user enter is correct format
// I can put this in seperate file if you guys want
function isCorrectDateFormat($date){
    if(strlen($date) < 10 || strlen($date) > 10){
        return false;
    }
    $dt = DateTime::createFromFormat("Y-m-d", $date);
    return $dt !== false && !array_sum($dt->getLastErrors());
}

if(isset($_COOKIE[$cookie])){
	$cookie_value = $_COOKIE[$cookie];
	$user_ID = $cookie_value;
}

$action = filter_input(INPUT_POST, 'action');
	switch($action) {
		case 'Display Miles':
		    $vehicle_id = filter_input(INPUT_POST, 'vehicle_id');
			$from_date = filter_input(INPUT_POST, 'from_date');
			$to_date = filter_input(INPUT_POST, 'to_date');
			
			// lots of user validation will look at possibility of switch case
			if(!filter_var($vehicle_id, FILTER_VALIDATE_INT)){
			    $response = "Please enter an id for vehicle";
			}
			else if(!isCorrectDateFormat($from_date) || !isCorrectDateFormat($to_date)){
			    $response = "You did not enter the correct format please try again";
			}
			else if($from_date > $today || $to_date > $today){
			    $response = "Dates cannot be in the future";
			}
			else if($from_date > $to_date){
			    $response = "From date cannot be bigger than To date";
			}
			else if($to_date < $from_date){
				$response = "To Date cannot be smaller than from_date";
			}
			else if(isCorrectDateFormat($from_date) and isCorrectDateFormat($to_date)){
		// If input is validated populateTable with functions from sql/sql.php
				$mile_id_array = array();
				$date_array = array();
				$miles_array = array();
				list($mile_id_array,$date_array,$miles_array) = populateTable($connection, $mile_id_array, $date_array, $miles_array, 
				$from_date, $to_date, $user_ID, $vehicle_id);
		
		// function for total miles within given range
				$milesInRange = rangeTotalMiles($connection,$from_date,$to_date,$user_ID,$vehicle_id);
		// function to get total miles since creation of user
				$totalMiles = totalMiles($connection, $user_ID, $vehicle_id);
				
				$response = "Miles in range given : $milesInRange <br>
				Total Miles since inception: $totalMiles";
			}
			break;
		
		case 'Edit - Delete':
			$mile_id = filter_input(INPUT_POST, 'mile_id');
			$query = "SELECT Mile_date, Mile_count FROM Miles WHERE Mile_ID = '$mile_id'";
			$select_mile_record = $connection -> prepare($query);
			$select_mile_record -> execute();
			$select_mile_record -> bind_result($mile_date_from_query,$mile_count_from_query);
			$select_mile_record->store_result();
		    while($select_mile_record -> fetch()) {
				$mile_date = $mile_date_from_query;
				$mile_count = $mile_count_from_query;
			}
			$select_mile_record -> free_result();
			$edit_record_flag = 1;
			break;
			
		case 'Edit Miles':
			$mile_id = filter_input(INPUT_POST, 'mile_id');
			$new_mile_date = filter_input(INPUT_POST, 'new_mile_date');
			$new_mile_count = filter_input(INPUT_POST, 'new_mile_count');
			
			// validate input
			if(filter_var($new_mile_count, FILTER_VALIDATE_INT) === false || $new_mile_count <= 0) {
		    	$response = "New miles driven must be a whole number greater than 0";
		    	break;
			} 
			
			$query = "UPDATE Miles SET Mile_date = '$new_mile_date', Mile_count = '$new_mile_count' WHERE Mile_ID = '$mile_id'";
			$update_mile_record = $connection -> prepare($query);
			if($update_mile_record -> execute()) {
				$response = "Mile record $mile_id updated.";
			}
			break;
			
	}
include("sql/populateVehicle.php");
//have it return the populated $vehicle_array
	$vehicle_array = array();
	$vehicle_array = populateVehicle($connection, $vehicle_array, $user_ID);
	$first_ID = key($vehicle_array);

	$connection->close();


include('mileagesummaryform.php');
?>