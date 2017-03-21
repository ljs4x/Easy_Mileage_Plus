<!-- Set Title -->
<?php $title = "Add Mileage"; ?>
<?php include('./include-files/header-login.php'); ?>
<!-- jQueryUi 1.12.1 datepicker -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
       $(function() {
               $("#inputDate").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });
  </script>

	<!-- Main content -->
	<div class="container addmiles-background">
		<div class="row">
			<div class="col-md-12">
 				<div class="container main-content">
 					<div class="main-content">
 						<h1>Add Mileage:</h1>
	 						<form action="addmiles.php" method="post">
								<!-- <label>Vehicle ID:</label> -->
								<input type="hidden" id="selected-vehicle" name="selected_vehicle"  maxlength="40" value="<?php echo $first_ID; ?>">
								<br>
								<div class="row">
									<div class="col-md-12">
										<label>Select a vehicle:</label>
										<select class="form-control" id="dropdown">
											<!--  <option value="Select a vehicle.">Select a Vehicle:</option> -->
											<?php
												foreach($vehicle_array as $x => $x_value) {  
												    echo "<option value='$x'>" . $x_value ."</option>";
												}
											?>
										</select>
										<!-- javascript drop down control -->
										<script>
											var mytextbox = document.getElementById('selected-vehicle'); 
											var mydropdown = document.getElementById('dropdown');
											
											mydropdown.onchange = function(){
											     mytextbox.value = this.value;
											};
										</script>
										<label>Date:</label>
										<input type="text" name="inputDate" id="inputDate" placeholder="YYYY-MM-DD"><br>
		
										<div id="miles-input">
											<label>Miles:</label>
											<input type="text" name="milesInput" id="milesInput"><br>
										</div>
										<div id="buttons" >
											<label>&nbsp;</label>
											<input type="submit" value="Submit" name="action" id="addmiles_submit_button"><br>
										</div><strong>
											<?php 
												if(isset($response)) {
													echo $response;
												}
												if(isset($errorFlag)) {
													echo $errorFlag;
												}
											?></strong>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
		
<?php include('./include-files/footer.php'); ?>