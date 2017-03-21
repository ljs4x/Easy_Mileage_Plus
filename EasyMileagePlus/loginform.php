<!-- Set Title -->
<?php $title = "Log In"; ?>
<!-- link to header files -->
<?php include('include-files/header.php'); ?> 

	<!-- Log in form-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="container sign-up-background">
					<div class="main-content">
					<h1><strong>Log In</strong></h1>
					<p>Enter Your information below:</p>
						<form action="login.php" method="post">
							<div id="data" >
								<label>Email:</label>
								<input type="text" name="email">
								<br>
								<label>Password:</label>
								<input type="password" name="password">
								<br>
								<div class="checkbox-line">
									<label class="check-box" for="remember-me">Remember Me:</label>
									<input type="checkbox" id="remember-me" name="remember-me">
								</div>
								<br>
							</div>
							<div id="response">
								<strong><?php echo $response; ?></strong>
							</div>
							<div id="buttons" >
								<label>&nbsp;</label>
								<input type="submit" value="Submit" id="signin_submit_button"><br>
							</div>
							<strong><p>Don't have an Account? <a href="signup.php">Sign Up</a> here.</p></strong>
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- link to footer file -->
<?php include('include-files/footer.php'); ?> 
