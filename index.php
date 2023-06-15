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
      
      
			//Unread notifications 
			$notifications = new Notification($con, $userLoggedIn);
			$num_notifications = $notifications->getUnreadNumber();

			//Unread notifications 
			$user_obj = new User($con, $userLoggedIn);
			$num_requests = $user_obj->getNumberOfFriendRequests();
		?>

<style>
    /* CSS for the navbar */
    nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #f1f1f1;
        padding: 10px;
        z-index: 100;
    }
    
    /* Add any other styles for the navbar here */
    
    /* Adjust the padding of the content below the navbar to avoid overlapping */
    body {
        padding-top: 50px; /* Adjust this value to match the height of the navbar */
    }
</style>
<head>
	
	<title>Welcome to Norsocmed</title>
<nav>
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

 <div class="nav-left">
        <a href="index.php" style="text-decoration: none;">
		<h2 style="color: #4d8bf5; font-family: 'Arial', sans-serif; font-size: 24px; font-weight: bold;">NORSOCMED</h2>

        </a>
        <ul>
            <li>
			<a href="requests.php" style="position: relative;">
    <?php
    if ($num_requests > 0)
        echo '<span class="not" id="unread_requests">' . $num_requests . '</span>';
    ?>
    <style>
        .not {
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
            top: -5px;
            right: -5px;
        }
		.container {
   
    /* Adjust the column sizes as needed */
    gap: 50px; /* Adjust the gap size as needed */
    padding: 50px;
}

.left-sidebar,
.main-content,
.right-sidebar {
    background-color: #f1f1f1;
    padding: 20px;
}
.left-sidebar h2,
.main-content h2,
.right-sidebar h2 {
    margin-top: 0;
}
    </style>
    <img src="images/friends.png" style="vertical-align: middle;">
</a>

            </li>
        </ul>
    </div>

	<div class="nav-right">
    <div class="search-box">
        <form action="search.php" method="GET" name="search_form">
            <input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search for Users to add " autocomplete="off" id="search_text_input">
        </form>
        <div class="search_results_dropdown">
            <!-- Search results will be dynamically populated here -->
        </div>
    </div>
    <div class="nav-user-icon online" onclick="settingsMenuToggle();">
        <img src="public/upload/no_image.jpg">
    </div>
</div>


<style>
.search_results_dropdown {
    position: absolute;
    width: 100%;
    background-color: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    z-index: 10;
    display: none;
}

.search_results_list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.search_results_list li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.search_results_list li:last-child {
    border-bottom: none;
}

.search_results_dropdown.show {
    display: block;
}


	</style>


	
    <div class="settings-menu">
        
        <div class="settings-menu-inner">
            <div class="user-profile">
                <img src="public/upload/no_image.jpg">
                <div>
                    <p><?php echo $user['first_name']; ?></p>
                    <a href="<?php echo $userLoggedIn; ?>">See Your Profile</a>
                </div>
            </div>
            <hr>
            
            <hr>
            <div class="settings-links">
                <img src="images/logout.png" class="settings-icon">
                <a href="includes/handlers/logout.php">Logout</a>
                <img src="images/arrow.png" width="10px">
            </div>
        </div>
    </div>
</nav>

					</head>



	




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
	
<?php 



if(isset($_POST['post'])){

	$uploadOk = 1;
	$imageName = "";
	$errorMessage = "";

	if($imageName != "") {
		$targetDir = "assets/images/posts/";
		$imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload']['size'] > 10000000) {
			$errorMessage = "Sorry your file is too large";
			$uploadOk = 0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk) {
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
				//image uploaded okay
			}
			else {
				//image did not upload
				$uploadOk = 0;
			}
		}

	}

	if($uploadOk) {
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], 'none', $imageName);
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}

}


 ?>


<?php
// Assuming $con is your database connection variable

// Function to get all registered users
function getAllUsers($con) {
  $users = array();
  $query = mysqli_query($con, "SELECT username FROM users");
  
  while ($row = mysqli_fetch_assoc($query)) {
    $users[] = $row['username'];
  }

  return $users;
}

// Get all registered users
$users = getAllUsers($con);

// Print the list of users

?>

 
 
	<div class="content">
		 <!-- Start Content-->
	
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
	
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

						
                     
						<div class="container">
			<div class="left-sidebar">
				<div class="imp-links">
				<style>
.title {
  font-size: 24px;
  font-weight: bold;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.user-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.user-item {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  padding: 10px;
  background-color: #f0f0f0;
  border-radius: 10px;
  box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1), -4px -4px 10px rgba(255, 255, 255, 0.5);
  transition: transform 0.3s ease;
}

.user-item:hover {
  transform: translateY(-5px);
}

.user-link {
  color: #333;
  text-decoration: none;
  font-weight: bold;
  margin-left: 10px;
}

.user-link:hover {
  color: #777;
}

</style>

<p class="title">Links for all Users</p>

<?php
echo '<ul class="user-list">';
foreach ($users as $username) {
  $userz = new User($con, $username);
  $profileLink = $userz->getUsername();
  echo '<li class="user-item">
          <i class="fas fa-user-circle"></i>
          <a class="user-link" href="' . $profileLink . '">' . $userz->getUsername() . '</a>
        </li>';
}
echo '</ul>';
?>


					
				</div>
				
			</div>

			<style>
				.user-profile,
.post-input-container {
  background-color: #f2f2f2;
  box-shadow: 6px 6px 10px rgba(0, 0, 0, 0.1), -6px -6px 10px rgba(255, 255, 255, 0.5);
  border-radius: 10px;
  padding: 10px;
}
.post {
  background-color: #f2f2f2;
  box-shadow: inset 6px 6px 10px rgba(0, 0, 0, 0.1), inset -6px -6px 10px rgba(255, 255, 255, 0.5);
  border: none;
  border-radius: 10px;
  padding: 10px;
  width: 100%;
  resize: none;
}

.post {
  background-color: #f2f2f2;
  box-shadow: 6px 6px 10px rgba(0, 0, 0, 0.1), -6px -6px 10px rgba(255, 255, 255, 0.5);
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  cursor: pointer;
}
.right-sidebar {
  background-color: #f2f2f2;
  box-shadow: 6px 6px 10px rgba(0, 0, 0, 0.1), -6px -6px 10px rgba(255, 255, 255, 0.5);
  border-radius: 10px;
  padding: 20px;
}
a {
  text-decoration: none;
  color: #000;
  background-color: #f2f2f2;
  box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1), -4px -4px 6px rgba(255, 255, 255, 0.5);
  border-radius: 10px;
  padding: 10px 20px;
  transition: all 0.3s ease;
}

a:hover {
  transform: translateY(-2px);
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1), -2px -2px 4px rgba(255, 255, 255, 0.5);
}
input[type="submit"],
button {
  background-color: #f2f2f2;
  box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1), -4px -4px 6px rgba(255, 255, 255, 0.5);
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  cursor: pointer;
  transition: all 0.3s ease;
}

input[type="submit"]:hover,
button:hover {
  transform: translateY(-2px);
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1), -2px -2px 4px rgba(255, 255, 255, 0.5);
}
.post,
.comment-button,
.like-button,
.edit-button {
  background-color: #f2f2f2;
  box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1), -4px -4px 6px rgba(255, 255, 255, 0.5);
  border: none;
  border-radius: 10px;
  padding: 8px 16px;
  margin-right: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.post:hover,
.comment-button:hover,
.like-button:hover,
.edit-button:hover {
  transform: translateY(-2px);
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1), -2px -2px 4px rgba(255, 255, 255, 0.5);
}

				</style>


			<div class="main-content">
				

				<div class="write-post-container">
					<div class="user-profile">
						<img src="public/upload/no_image.jpg">
						<div>
							<p><?php echo $user['first_name'] . " " . $user['last_name'] ?></p>
							
						</div>
					</div>

					<div class="post-input-container">
    <form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
        <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
        <input type="submit" name="post" id="post_button" value="Post" style="background-color: #f1f1f1; border-radius: 10px; box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2), -4px -4px 8px rgba(255, 255, 255, 0.5); padding: 5px 5px; margin-top: 10px; border: none; cursor: pointer;">
        <br>
        <br>
        <br>
    </form>
</div>

				</div>



				<div class="post-container">
					
					
					<div class="posts_area"></div>
		<!-- <button id="load_more">Load More Posts</button> -->
		<img id="loading" src="assets/images/icons/loading.gif">

					
					
				</div>
				
			</div>



			
			<div class="right-sidebar animated fadeIn">
				<div class="sidebar-title">
					<h4>Events</h4>
					<a href="#">See All</a>
				</div>
				<div class="event">
					<div class="left-event">
						<h3>18</h3>
						<span>March</span>
					</div>
					<div class="right-event">
						<h4>Social Media</h4>
						<p>
							<i class="fa fa-map-marker"></i>
							Willson Tech Park
						</p>
						<a href="#">More Info</a>
					</div>
				</div>
				<div class="event">
					<div class="left-event">
						<h3>22</h3>
						<span>June</span>
					</div>
					<div class="right-event">
						<h4>Mobile Marketing</h4>
						<p>
							<i class="fa fa-map-marker"></i>
							Willson Tech Park
						</p>
						<a href="#">More Info</a>
					</div>
				</div>

				<div class="sidebar-title">
					<h4>Advertisement</h4>
					<a href="#">Close</a>
				</div>
				<img src="images/advertisement.png" class="sidebar-ads">

				<div class="sidebar-title">
					<h4>Conversation</h4>
					<a href="#">Hide Chat</a>
				</div>
				<div class="online-list">
					<div class="online">
						<img src="images/member-1.png">
					</div>
					<p>Alison Mina</p>
				</div>
				<div class="online-list">
					<div class="online">
						<img src="images/member-2.png">
					</div>
					<p>Jackson Aston</p>
				</div>
				<div class="online-list">
					<div class="online">
						<img src="images/member-3.png">
					</div>
					<p>Samona Rose</p>
				</div>
			</div>
		</div>
		<div class="footer">
			<p>Copyright 2023 </p>
		</div>
	





	






	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide();
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
		//$('#load_more').on("click", function() {

			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
			//if (noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
						$('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage 

						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>




	</div>
</body>
</html>