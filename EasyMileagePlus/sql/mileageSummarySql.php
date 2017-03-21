<?php
    include("./conn_proc.php");
    
//populate tables with all entry in given range
    function populateTable($connection, $mile_id_array, $date_array, $miles_array,
    $from_date, $to_date, $user_ID, $vehicle_id){
        $query = "SELECT Mile_ID, Mile_date, Mile_count 
				  FROM Miles
				  WHERE Mile_date >= ? 
				  AND Mile_date <= ? 
				  AND User_ID = ? 
				  AND Vehicle_ID = ?
				  ORDER BY Mile_date
				  LIMIT 50";
		$entryTableStatement = $connection->prepare($query);
		$entryTableStatement -> bind_param('ssii',$from_date, $to_date, $user_ID, $vehicle_id);
		$entryTableStatement -> execute();
		$num_rows = $entryTableStatement->num_rows;
		$entryTableStatement -> bind_result($mile_id, $date, $miles);
		while($entryTableStatement -> fetch()) {
			$mile_id_array[] = $mile_id;
			$date_array[] = $date;
			$miles_array[] = $miles;
		}
	    $entryTableStatement -> free_result();
        return array($mile_id_array,$date_array,$miles_array);
    }
// Calculate total miles within given range return back a result.
    function rangeTotalMiles($connection, $from_date, $to_date, $user_ID, $vehicle_id){
        		$rangeQuery = "SELECT SUM(Mile_count) 
					   FROM Miles 
					   WHERE Mile_date >= ? 
					   AND Mile_date <= ? 
					   AND User_ID = ? 
					   AND Vehicle_ID = ?";
		$rangeStatement =  $connection->prepare($rangeQuery);
		$rangeStatement->bind_param('ssii', $from_date, $to_date, $user_ID, $vehicle_id);
		$rangeStatement->execute();
		$result = $rangeStatement->get_result();
		while ($row  = $result->fetch_array(MYSQLI_NUM)){
			foreach ($row as $r){
				$milesInRange = $r;
			}
		}
		$rangeStatement->free_result();
		return $milesInRange;
    }
// Calculate total amount of miles since inception
    function totalMiles($connection, $user_ID, $vehicle_id){
        $totalMilesQuery = "SELECT SUM(Mile_count)
							FROM Miles
							WHERE User_ID = ?
							AND Vehicle_ID = ?";
		$totalMilesStatement = $connection->prepare($totalMilesQuery);
		$totalMilesStatement->bind_param('ii', $user_ID, $vehicle_id);
		$totalMilesStatement->execute();
		$result = $totalMilesStatement->get_result();
		while ($row = $result ->fetch_array(MYSQLI_NUM)){
			foreach ($row as $r){
				$totalMiles = $r;
			}
		}
		$totalMilesStatement->free_result();
		return $totalMiles;
    }
    

?>