<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Welcome to NORSOCMED!</title>
	<link rel="stylesheet" type="text/css" href="register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

<?php  

if(isset($_POST['register_button'])) {
    echo '
    <script>
        $(document).ready(function() {
            $("#first").hide();
            $("#second").show();
        });
    </script>';
} else {
    echo '
    <script>
        $(document).ready(function() {
            $("#first").show();
            $("#second").hide();
        });
    </script>';
}

?>


	<div class="content">

		<div class="login_box">

			<div class="text">
				NORSOCMED
				
			</div>
			
			<div id="first">

				<form action="register.php" method="POST">
				<div class="field">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					</div>
					<div class="field">
					<input type="password" name="log_password" placeholder="Password">
				</div>
					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  '<p style="font-size: 12px; color: red;">Email or password was incorrect</p>'; ?>
					<button type="submit" name="login_button">Login</button>

					<div class="sign-up">
					<a href="#" id="signup" class="signup">Need an account? Register here!</a>
					</div>
				</form>

			</div>

			<div id="second">

				<form action="register.php" method="POST">
				<div class="field">
					<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					</div>
					<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo '<p style="font-size: 12px; color: red;">Your first name must be between 2 and 25 characters</p>'; ?>

					
					

					<div class="field">
					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					</div>
					<br>
					<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo '<p style="font-size: 12px; color: red;">Your last name must be between 2 and 25 characters</p>'; ?>
					<div class="field">
					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					</div>
					<br>
					<div class="field">
					<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					</div>
					<br>
					<?php if(in_array("Email already in use<br>", $error_array)) echo '<p style="font-size: 12px; color: red;">Email already in use</p>'; 
					else if(in_array("Invalid email format<br>", $error_array)) echo '<p style="font-size: 12px; color: red;">Invalid email format</p>';
					else if(in_array("Emails don't match<br>", $error_array)) echo '<p style="font-size: 12px; color: red;">Emails do not match </p>'; ?>

					<div class="field">
					<input type="password" name="reg_password" placeholder="Password" required>
						</div>
						<br>
						<div class="field">
							<input type="password" name="reg_password2" placeholder="Confirm Password" required>
						</div>
					
							<?php if(in_array("Your passwords do not match<br>", $error_array)) echo '<p style="font-size: 12px; color: red;">Your passwords do not match</p>'; 
							else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
							else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>


						
							<button type="submit" name="register_button">Register</button>
							
							<div class="sign-up">
					<?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
					<a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
							</div>
				</form>
			</div>

		</div>

	</div>


</body>
</html>