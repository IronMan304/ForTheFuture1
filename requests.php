<style>
.column {
  background-color: #f0f0f0;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1), -4px -4px 10px rgba(255, 255, 255, 0.5);
  transition: transform 0.3s ease;
}

.column:hover {
  transform: translateY(-5px);
}

.title {
  font-size: 24px;
  font-weight: bold;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.friend-request {
  background-color: #f0f0f0;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 10px;
  box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1), -4px -4px 10px rgba(255, 255, 255, 0.5);
  transition: transform 0.3s ease;
}

.friend-request:hover {
  transform: translateY(-5px);
}

.btn-container {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

.btn {
  padding: 5px 15px;
  margin: 0 5px;
  border: none;
  border-radius: 5px;
  background-color: #ddd;
  color: #333;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #ccc;
}
</style>

<?php
include("includes/header.php"); //Header 
?>

<div class="main_column column" id="main_column">

	<h4 class="title">Friend Requests</h4>

	<?php  

	$query = mysqli_query($con, "SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'");
	if(mysqli_num_rows($query) == 0)
		echo "You have no friend requests at this time!";
	else {

		while($row = mysqli_fetch_array($query)) {
			$user_from = $row['user_from'];
			$user_from_obj = new User($con, $user_from);

			echo '<div class="friend-request">';
			echo $user_from_obj->getFirstAndLastName() . " sent you a friend request!";

			$user_from_friend_array = $user_from_obj->getFriendArray();

			if(isset($_POST['accept_request' . $user_from ])) {
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username='$userLoggedIn'");
				$add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$userLoggedIn,') WHERE username='$user_from'");

				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "You are now friends!";
				header("Location: requests.php");
			}

			if(isset($_POST['ignore_request' . $user_from ])) {
				$delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
				echo "Request ignored!";
				header("Location: requests.php");
			}

			echo '<div class="btn-container">
					<form action="requests.php" method="POST">
						<input type="submit" name="accept_request' . $user_from . '" class="btn" value="Accept">
						<input type="submit" name="ignore_request' . $user_from . '" class="btn" value="Ignore">
					</form>
				  </div>';
			echo '</div>';
		}
	}
	?>
	
</div>
<style>
    .image-container {
        display: flex;
        justify-content: center;
        padding: 50px;
    }
    
    .image-container img {
        width: 215px; /* Set the desired width */
        height: auto; /* Maintain aspect ratio */
    }
</style>

<div class="image-container">
    <img class="randy" src="public/upload/randy.jpg" alt="Randy">
</div>

