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

.search-result {
  background-color: #f0f0f0;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 10px;
  box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1), -4px -4px 10px rgba(255, 255, 255, 0.5);
  transition: transform 0.3s ease;
}

.search-result:hover {
  transform: translateY(-5px);
}

.searchPageFriendButtons {
  display: flex;
  justify-content: center;
  margin-bottom: 10px;
}

.input-btn {
  padding: 5px 10px;
  margin: 0 5px;
  border: none;
  border-radius: 5px;
  background-color: #ddd;
  color: #333;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.input-btn.danger {
  background-color: #ff5757;
  color: #fff;
}

.input-btn.danger:hover {
  background-color: #ff0000;
}

.input-btn.warning {
  background-color: #ffc107;
  color: #333;
}

.input-btn.warning:hover {
  background-color: #ff9800;
}

.input-btn.default {
  background-color: #ccc;
  color: #333;
}

.input-btn.default:hover {
  background-color: #999;
}

.input-btn.success {
  background-color: #4caf50;
  color: #fff;
}

.input-btn.success:hover {
  background-color: #45a049;
}

.result-profile-pic {
  text-align: center;
  margin-bottom: 10px;
}

.result-profile-pic img {
  height: 100px;
}

.search_hr {
  border: none;
  height: 1px;
  background-color: #ccc;
  margin-top: 20px;
}
</style>

<?php
include("includes/header.php");

if(isset($_GET['q'])) {
	$query = $_GET['q'];
}
else {
	$query = "";
}

if(isset($_GET['type'])) {
	$type = $_GET['type'];
}
else {
	$type = "name";
}
?>

<div class="main_column column" id="main_column">

	<?php 
	if($query == "")
		echo "You must enter something in the search box.";
	else {

		//If query contains an underscore, assume the user is searching for usernames
		if($type == "username") 
			$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
		//If there are two words, assume they are first and last names respectively
		else {

			$names = explode(" ", $query);

			if(count($names) == 3)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') AND user_closed='no'");
			//If the query has one word only, search first names or last names 
			else if(count($names) == 2)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no'");
			else 
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no'");
		}

		//Check if results were found 
		if(mysqli_num_rows($usersReturnedQuery) == 0)
			echo "We can't find anyone with a " . $type . " like: " .$query;
		else 
			echo mysqli_num_rows($usersReturnedQuery) . " results found: <br> <br>";


		echo "<p id='grey'>Try searching for:</p>";
		echo "<a href='search.php?q=" . $query ."&type=name'>Names</a>, <a href='search.php?q=" . $query ."&type=username'>Usernames</a><br><br><hr class='search_hr'>";

		while($row = mysqli_fetch_array($usersReturnedQuery)) {
			$user_obj = new User($con, $user['username']);

			$button = "";
			$mutual_friends = "";

			if($user['username'] != $row['username']) {

				//Generate button depending on friendship status 
				if($user_obj->isFriend($row['username']))
					$button = "<input type='submit' name='" . $row['username'] . "' class='input-btn danger' value='Remove Friend'>";
				else if($user_obj->didReceiveRequest($row['username']))
					$button = "<input type='submit' name='" . $row['username'] . "' class='input-btn warning' value='Respond to request'>";
				else if($user_obj->didSendRequest($row['username']))
					$button = "<input type='submit' class='input-btn default' value='Request Sent'>";
				else 
					$button = "<input type='submit' name='" . $row['username'] . "' class='input-btn success' value='Add Friend'>";

				$mutual_friends = $user_obj->getMutualFriends($row['username']) . " friends in common";


				//Button forms
				if(isset($_POST[$row['username']])) {

					if($user_obj->isFriend($row['username'])) {
						$user_obj->removeFriend($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
					else if($user_obj->didReceiveRequest($row['username'])) {
						header("Location: requests.php");
					}
					else if($user_obj->didSendRequest($row['username'])) {

					}
					else {
						$user_obj->sendRequest($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}

				}
			}

			echo "<div class='search-result'>
					<div class='searchPageFriendButtons'>
							<form action='' method='POST'>
								" . $button . "
								<br>
							</form>
					</div>

					<div class='result-profile-pic'>
						<a href='" . $row['username'] ."'><img src='". $row['profile_pic'] ."' style='height: 100px;'></a>
					</div>

					<a href='" . $row['username'] ."'> " . $row['first_name'] . " " . $row['last_name'] . "
						<p id='grey'> " . $row['username'] ."</p>
					</a>
					<br>
					" . $mutual_friends ."<br>

				</div>
				<hr class='search_hr'>";

		} //End while
	}
?>

</div>
