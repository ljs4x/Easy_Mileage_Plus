<!-- Set Title -->
<?php $title = "Sign Up"; ?>
<!-- link to header file -->
<?php include('include-files/header.php'); ?> 
	
	<div class="container">		
		<div class="row">
			<div class="col-md-12">
				<div class="container sign-up-background">
					<div class="main-content">
					<h1><strong>Sign Up</strong></h1>
					<p>Enter Your information below:</p>
						<form action="signup.php" method="post">
							<div>
								<label>Email:</label>
								<input type="text" name="email"><br>
								<label>Password:</label>
								<input type="password" name="password"><br>
								<label>Repeat Password:</label>
								<input type="password" name="password_repeat"><br>
							</div>
						<div id="response">
							<strong><?php echo $response; ?></strong>
						</div>
							<?php if($login == true) : ?>
								<br>
								<div id="login-button">
									<a href="./login.php" class="button-link">Log In</a>
								</div>
								<br>
							<?php else: ?>
								<div id="buttons" >
									<label>&nbsp;</label>
									<input type="submit" value="Submit" id="signup_submit_button"><br>
								</div>
							</form>
							<?php endif; ?>
							<strong><p>Already have an Account? <a href="login.php">Log in</a> here.</p></strong>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!-- Link to footer file -->
<?php include('include-files/footer.php'); ?> 
