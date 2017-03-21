<!-- Set Title -->
<?php $title = "Account"; ?>
<!-- Link to header and navigation file -->
<?php include('include-files/header-login.php'); ?> 

	<!-- main content -->
	<div class="container account-background">
  		<div class="container main-content">
			<div class="row">
				<div class="col-md-12">
					<h1>Account:</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
			  			<li class="active"><a data-toggle="tab" href="#vehicle-settings">Vehicle Settings</a></li>
						<li><a data-toggle="tab" href="#account-settings">Account Settings</a></li>
					</ul>
				</div>
			</div>
			<div class="tab-content">
		  		<div id="vehicle-settings" class="tab-pane fade in active">
					<div class="row">
						<div class="col-md-12">
							<h2>Vehicle Settings:</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="content-divide"></div>
							<h3>Your vehicle list:</h3>
							<div id="vehicle_list_form">
								<form action="account.php" method = "post">
									<!-- <label>Vehicle ID:</label> -->
									<input type="hidden" id="selected-vehicle" name="selected_vehicle" value="<?php echo $first_ID; ?>">
									<select class="form-control" id="dropdown">
										<!-- <option value="Select a vehicle.">Select a Vehicle:</option> -->
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
									var myvehicleid = document.getElementById('vehicle-id');
									
									mydropdown.onchange = function(){
									     mytextbox.value = this.value;
									};
									</script>
									<div id="buttons" >
										<label>&nbsp;</label>
										<input type="submit" name="action" value="Delete Vehicle" id="delete_vehicle_button"><br>
									</div>
								</form>	
							</div>
						</div>
					</div>	
					<div class="content-divide"></div>
					<div class="row">
						<div class="col-md-12">
							<h3>Add Vehicle:</h3>
							<form action="account.php" method="post">
								<div class="col-md-6">
									<label>Make:</label>
											<input type="text" name="make">
											<br>
									<label>Model:</label>
										<input type="text" name="model">
										<br>
								</div>
								<div class="col-md-6">
									<label>Year:</label>
									<input type="text" name="year">
									<br>
									<label>License Plate Number:</label>
									<input type="text" name="license_plate_number">
									<br>
										<div class="checkbox-line">
										<label class="check-box" for="checkbox">Set as default vehicle:</label>
										<input type="checkbox" name="default" value=1><br>
										</div>
								</div>

						</div>
					</div>
						<div class="row">
							<div class="col-md-12">
								<div id="buttons" >
								<label>&nbsp;</label>
								<input type="submit" name="action" value="Add Vehicle" id="add_vehicle_button">
								<br>
								</div>
							</div>
							</form>
						</div>
				</div>
				<div id="account-settings" class="tab-pane fade">
				  	<div class="row">
						<div class="col-md-12">
							<h2>Account Settings:</h2>
						</div>
					</div>
					<div class="content-divide"></div>
					<div class="row">
						<div class="col-md-12">	
							<h3>Change password:</h3>
							<form action="account.php" method="post">
								<div>
									<label>Current Password:</label>
									<input type="password" name="password">
									<br>
									<label>New password:</label>
									<input type="password" name="password_new">
									<br>
									<label>Repeat new password:</label>
									<input type="password" name="password_new_repeat">
									<br>
								</div>
						</div>	
					</div>		
					<div class="row">
						<div class="col-md-12">			
							<div id="buttons">
								<label>&nbsp;</label>
								<input type="submit" name="action" value="Change Password" id="change_password_submit_button">
								<br>
							</div>
							</form>	
						</div>
					</div>
					<div class="content-divide"></div>
					<div class="row">
						<div class="col-md-12">
							<h3>Change Email:</h3>
							<form action="account.php" method="post">
								<div>
									<label>New email:</label>
									<input type="text" name="email_new">
									<br>
									<label>Repeat new email:</label>
									<input type="text" name="email_new_repeat">
									<br>
									<label>Password:</label>
									<input type="password" name="password"><br>
								</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="buttons">
									<label>&nbsp;</label>
									<input type="submit" name="action" value="Change Email" id="change_email_submit_button"><br>
								</div>
								</form>
							</div>
						</div>
					</div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<?php 
							if(count($response) > 0) : ?>
								<ul>
						            <?php foreach($response as $resp) : ?>
						                <li><strong><?php echo $resp; ?></strong></li>
						            <?php endforeach; ?>
						        </ul>
				        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Link to footer file -->	
<?php include('include-files/footer.php'); ?> 