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
	
	<title>Welcome to Norsocmed</title>

	



	

	

<link rel="stylesheet" type="text/css" href="css/style.css"> <!--navbar-->
<link rel="stylesheet" type="text/css" href="css/profile.css"> 



<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	

	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> <!-- for profile -->

	
</head>
<body>

<style>
	/* Navbar */
/* Navbar */
nav {
	
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background-color: #f2f2f2;
  border-radius: 10px;
  box-shadow: 6px 6px 12px rgba(155, 166, 179, 0.3), -6px -6px 12px rgba(255, 255, 255, 0.7);
}

.nav-left h2 {
  color: #333;
  font-family: 'Arial', sans-serif;
  font-size: 24px;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(155, 166, 179, 0.3);
}

.nav-right {
  display: flex;
  align-items: center;
}

.nav-right .search-box {
  position: relative;
}

.nav-right input[type="text"] {
  width: 200px;
  padding: 8px;
  border: none;
  border-radius: 5px;
  background-color: #f2f2f2;
  box-shadow: inset 4px 4px 10px rgba(155, 166, 179, 0.3), inset -4px -4px 10px rgba(255, 255, 255, 0.7);
  outline: none;
  transition: box-shadow 0.3s ease;
}

.nav-right input[type="text"]:focus {
  box-shadow: inset 6px 6px 12px rgba(155, 166, 179, 0.3), inset -6px -6px 12px rgba(255, 255, 255, 0.7);
}

.nav-right .search_results_footer_empty {
  display: none;
}

.nav-right .search_results {
  position: absolute;
  top: 40px;
  left: 0;
  width: 100%;
  max-height: 200px;
  overflow-y: auto;
  background-color: #f2f2f2;
  box-shadow: 6px 6px 12px rgba(155, 166, 179, 0.3), -6px -6px 12px rgba(255, 255, 255, 0.7);
  border-radius: 5px;
  padding: 5px;
  z-index: 1;
}

.nav-right .search_results a {
  display: block;
  padding: 8px;
  color: #333;
  text-decoration: none;
}

.nav-right .search_results a:hover {
  background-color: #ddd;
}

.nav-right .settings-menu {
  position: relative;
  margin-left: 10px;
  cursor: pointer;
}

.nav-right .settings-menu-inner {
  position: absolute;
  top: 30px;
  right: 0;
  width: 200px;
  background-color: #f2f2f2;
  box-shadow: 6px 6px 12px rgba(155, 166, 179, 0.3), -6px -6px 12px rgba(255, 255, 255, 0.7);
  border-radius: 5px;
  padding: 10px;
  display: none;
  z-index: 1;
}

.nav-right .settings-menu-inner hr {
  margin: 5px 0;
}

.nav-right .settings-links {
  display: flex;
  align-items: center;
  margin-bottom: 5px;
}

.nav-right .settings-links a {
  margin-left: 5px;
  color: #333;
  text-decoration: none;
}

.nav-right .settings-icon {
  width: 20px;
  height: 20px;
}

.nav-right .settings-menu:hover .settings-menu-inner {
  display: block;
}

/* Title Icons */
.nav-left h2 img,
.nav-right a img,
.nav-user-icon img {
  border-radius: 50%;
  background-color: #f2f2f2;
  box-shadow: 6px 6px 12px rgba(155, 166, 179, 0.3), -6px -6px 12px rgba(255, 255, 255, 0.7);
}

.nav-left h2 img:hover,
.nav-right a img:hover,
.nav-user-icon img:hover {
  box-shadow: 6px 6px 12px rgba(0, 0, 0, 0.3), -6px -6px 12px rgba(255, 255, 255, 0.7);
}


</style>
	
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
							
							<a href="index.php" style="text-decoration: none;">
							<h2 style="color: #4d8bf5; font-family: 'Arial', sans-serif; font-size: 24px; font-weight: bold;">NORSOCMED</h2>
				</a>

					


				<ul>
				
					
				<li>
					<a href="requests.php">
						<?php
				if($num_requests > 0)
				 echo '<span class="not" id="unread_requests">' . $num_requests . '</span>';
				?>
				<style>.not{
					
						padding: 3px 7px;
		font-size: 12px;
		font-weight: 700;
		line-height: 1;
		color: #fff;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		background-color: red;
		border-radius: 10px;
		position: absolute;
		
		top: 4px;
					}
					</style>
						<img src="images/friends.png">
					
				</a>
						</li>
						
					</ul>
				</div>
				<div class="nav-right">



				<div class="search-box">

	<form action="search.php" method="GET" name="search_form">
		
		<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search for users to add" autocomplete="off" id="search_text_input">

		

	</form>

	<div class="search_results_footer_empty">
	<div class="search_results">
				</div>
	</div>

	</div>


					<div class="nav-user-icon online" onclick="settingsMenuToggle();">
						<img src="public/upload/randy.jpg">
					</div>
				</div>

				<div class="settings-menu">
					
					<div class="settings-menu-inner">
						<div class="user-profile">
							<img src="public/upload/randy.jpg">
							<div>
								<p><?php echo $user['first_name']; ?></p>
								<a href="<?php echo $userLoggedIn; ?>">See Your Profile</a>
							</div>
						</div>
						<hr>
						
					

					
					
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
	