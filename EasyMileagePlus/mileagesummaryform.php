<!-- Set Title -->
<?php $title = "Mileage Summary"; ?>
<!-- Link to header and navigation file -->
<?php include('include-files/header-login.php'); ?> 
<!-- jQueryUi 1.12.1 datepicker -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
       $(function() {
               $("#from-date").datepicker({ dateFormat: "yy-mm-dd" }).val()
               $("#to-date").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });
   </script>
   <script type="text/javascript">
    function btoggle(divId) {
        var e = document.getElementById(divId);
        if (e.style.display == 'none') {
            e.style.display = 'block';
        } else {
            e.style.display = 'none';
        }
    }
	</script>
	
	<!-- main content -->
	<div class="container main-background">
  		<div class="container main-content">
			<div class="row">
				<div class="col-md-12">
						<h1> Mileage Summary</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form action = "mileagesummary.php" method ="post">
						<label>Vehicle:</label>
						<input type = "hidden" name = "vehicle_id" id="vehicle_id" value="<?php echo $first_ID; ?>">
						<select class="form-control" id="dropdown">
								<?php
											foreach($vehicle_array as $x => $x_value) {  
											    echo "<option value='$x'>" . $x_value ."</option>";
											}
										?>
						</select>
								<!-- javascript drop down control -->
								<script>
								var mytextbox = document.getElementById('vehicle_id'); 
								var mydropdown = document.getElementById('dropdown');
								var myvehicleid = document.getElementById('vehicle-id');
								
								mydropdown.onchange = function(){
								     mytextbox.value = this.value;
								};
								</script>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label>From:</label>
					<input type="text" name="from_date" id="from-date" placeholder = "yyyy-mm-dd">
				</div>		
				<div class="col-md-6">	
					<label>To:</label>
					<input type="text" name="to_date" id="to-date" placeholder = "yyyy-mm-dd">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">	
					<input type="submit" value="Display Miles" name="action"/>
					</form>
				<div class="content-divide"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					
					<!-- this section displays if someone clicks the Edit/Delete button -->
					<?php if($edit_record_flag == 1): ?>
					<!-- <div id="edit-mileage-form" style="display:none;"> -->
						<div id="edit-mileage-form">
							<form action="mileagesummary.php" method="post">
								<p><strong>Edit Mileage:</strong></p>
								<p>Editing entry for date:</p>
								<input style="text" name="new_mile_date" value="<?php echo $mile_date ?>">
								<p>Miles to edit:</p>
								<input style="text" name="new_mile_count" value="<?php echo $mile_count ?>">
								<input type="hidden" name = "mile_id" value="<?php echo $mile_id; ?>"
								<div id="buttons" >
								<label>&nbsp;</label>
									<input type="submit" value="Edit Miles" name="action"/>
								</div>
							</form>
							<div class="content-divide"></div>
						</div>
					<?php endif; ?>
					
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
							<?php if(isset($date_array)): ?>
								<table class="result-table">
								<tr>
									<th>Date:</th>
									<th>Mileage:</th>
								</tr>
								<?php for($i = 0, $l = count($date_array); $i < $l; $i++):?> 
									<tr>
									
									<td width="90px"><?php echo ($date_array[$i]); ?></td>
									<td width="90px"><?php echo ($miles_array[$i]); ?></td>
									
									
									
									<!-- Submit value="php echo Mile_ID[$i]" name Edit/Delete go here 
									change this to go back to the php part, send the Mile ID with it.  switch statement on the action
									should work. 
									
									-->
									
									<td width="50px">
										<form action="mileagesummary.php" method="post">
											<input type="hidden" value="<?php echo ($mile_id_array[$i]); ?>" name="mile_id">
											<input class="button-edit" type="submit" name="action" value="Edit - Delete">
										</form>
									</td>
									</tr>
									
								<?php endfor; ?>		
							<?php endif; ?>
					</table>
					<div id="response">
						<?php echo $response; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Link to footer file -->	
<?php include('include-files/footer.php'); ?> 

