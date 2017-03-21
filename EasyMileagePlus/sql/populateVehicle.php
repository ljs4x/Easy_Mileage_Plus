<?php 
    include("./conn_proc.php");
    function populateVehicle($connection, $vehicle_array, 
    $user_ID){
        $query = "SELECT Vehicle_ID, CONCAT(Vehicle_make, ' ', Vehicle_model) AS car 
        FROM Vehicles WHERE User_ID = ? ORDER BY Vehicle_default DESC";
        $vehicleListStatement = $connection->prepare($query);
        $vehicleListStatement -> bind_param('i', $user_ID);
        $vehicleListStatement -> execute();
        $vehicleListStatement -> bind_result($vehicle_id, $vehicle);
        while($vehicleListStatement -> fetch()) {
        	$vehicle_array[$vehicle_id] = $vehicle;
        }
        $vehicleListStatement -> free_result();
        return $vehicle_array;
    }
?>