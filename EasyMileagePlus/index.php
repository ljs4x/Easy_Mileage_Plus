<!-- Set Title -->
<?php $title = "Easy Mileage Plus"; ?>
<!-- Link to header and navigation file -->
<?php include('include-files/header.php'); ?> 

	<!-- Javascript for learn more button activity -->
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

 	<!-- Main body content -->	
  	<div id="body" class="container">
		<div class="row">
			<div class="container slogan-background">
				<div class="slogan">
					<h1><strong>Your Mileage, Your way. <br>It's that easy.</strong></h1>
					<a href="./signup.php" class="button-link">Sign Up</a>
					<input id="learn-more" type="button" value="Learn More" OnClick="btoggle('learn-more-data');"/>
				</div>
			</div>
			<div class="container learn-more-background">
				<div id="learn-more-data" style="display:none;">
					<p><b>Easy Mileage Plus</b> is a dynamic web-based mileage tracking program 
					designed for the delivery industry.</p>
				</div>
			</div>
		</div>
	</div>	
		
		
<!-- Link to footer file -->	
<?php include('include-files/footer.php'); ?> 