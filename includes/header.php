<?php  
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

include("includes/classes/Notification.php");


if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else {
	header("Location: register.php");
}

?>

<html>
<head>
	
	<title>Welcome to Swirlfeed</title>

	

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>


	
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />

	
</head>
<body>
	
<?php
			

			//Unread notifications 
			$notifications = new Notification($con, $userLoggedIn);
			$num_notifications = $notifications->getUnreadNumber();

			//Unread notifications 
			$user_obj = new User($con, $userLoggedIn);
			$num_requests = $user_obj->getNumberOfFriendRequests();
		?>




	<nav>
	
			<div class="nav-left">
			
			<a href="index.php"><img src="images/logo.png" class="logo"></a>
	


				<ul>
				<li>
				<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
				<img src="images/notification.png">
				<?php
				if($num_notifications > 0)
				 echo '<span class="notification_badge" id="unread_notification">' . $num_notifications . '</span>';
				?>
			</a>
				</li>
					
					<li>
					<a href="requests.php">
					<img src="images/notification.png">
				<?php
				if($num_requests > 0)
				 echo '<span class="notification_badge" id="unread_requests">' . $num_requests . '</span>';
				?>
			</a>
					</li>
					
				</ul>
			</div>
			<div class="nav-right">



			<div class="search-box">

<form action="search.php" method="GET" name="search_form">
	
	<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

	

</form>



<div class="search_results_footer_empty">
</div>



</div>


				<div class="nav-user-icon online" onclick="settingsMenuToggle();">
					<img src="images/profile-pic.png">
				</div>
			</div>

			<div class="settings-menu">
				<div id="dark-btn">
					<span></span>
				</div>
				<div class="settings-menu-inner">
					<div class="user-profile">
						<img src="images/profile-pic.png">
						<div>
							<p><?php echo $user['first_name']; ?></p>
							<a href="<?php echo $userLoggedIn; ?>">See Your Profile</a>
						</div>
					</div>
					<hr>
					<div class="user-profile">
						<img src="images/feedback.png">
						<div>
							<p>Give Feedback</p>
							<a href="#">Help us to improve the new design</a>
						</div>
					</div>
					<hr>

					<div class="settings-links">
						<img src="images/setting.png" class="settings-icon">
						<a href="settings.php">Settings & Privacy</a>
						<img src="images/arrow.png" width="10px">
					</div>
					<div class="settings-links">
						<img src="images/help.png" class="settings-icon">
						<a href="#">Help & Support</a>
						<img src="images/arrow.png" width="10px">
					</div>
					<div class="settings-links">
						<img src="images/display.png" class="settings-icon">
						<a href="#">Display & Accessibility</a>
						<img src="images/arrow.png" width="10px">
					</div>
					<div class="settings-links">
						<img src="images/logout.png" class="settings-icon">
						<a href="includes/handlers/logout.php">Logout</a>
						<img src="images/arrow.png" width="10px">
					</div>
				</div>
			</div>
	</nav>




	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('.dropdown_data_window').scroll(function() {
			var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing data
			var scroll_top = $('.dropdown_data_window').scrollTop();
			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

			if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

				var pageName; //Holds name of page to send ajax request to
				var type = $('#dropdown_data_type').val();


				if(type == 'notification')
					pageName = "ajax_load_notifications.php";
				else if(type == 'message')
					pageName = "ajax_load_messages.php"


				var ajaxReq = $.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage 
						$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage 


						$('.dropdown_data_window').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>

<script src="js/script.js"></script>
	<div class="wrapper">