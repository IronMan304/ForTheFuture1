<?php 
include("includes/header.php");



if(isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	$num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
}



if(isset($_POST['remove_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->removeFriend($username);
}

if(isset($_POST['add_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->sendRequest($username);
}
if(isset($_POST['respond_request'])) {
	header("Location: requests.php");
}

if(isset($_POST['post_message'])) {
  if(isset($_POST['message_body'])) {
    $body = mysqli_real_escape_string($con, $_POST['message_body']);
    $date = date("Y-m-d H:i:s");
    $message_obj->sendMessage($username, $body, $date);
  }


  echo "<script> 
          $(function() {
              $('" . $link ."').tab('show');
          });
        </script>";
}

 ?>

 	<style type="text/css">
	 	.wrapper {
	 		margin-left: 0px;
			padding-left: 0px;
	 	}

 	</style>
	
  <!-- profile pic -->
  <div class="wrapper">
 	 <div class="img-area">
      <div class="inner-area">
        <img src="public/upload/no_image.jpg" alt="">
      </div>
    </div>
    <div class="icon arrow"><i class="fas fa-arrow-left"></i></div>
    <div class="icon dots"><i class="fas fa-ellipsis-v"></i></div>
    <div class="name"><?php echo $user_array['first_name'] . ' ' . $user_array['last_name']; ?></div>

    


    
    <!-- //If mang add friend ka -->
 		<form action="<?php echo $username; ?>" method="POST">
 			<?php 
 			$profile_user_obj = new User($con, $username); 
 			if($profile_user_obj->isClosed()) {
 				header("Location: user_closed.php");
 			}

 			$logged_in_user_obj = new User($con, $userLoggedIn); 

 			if($userLoggedIn != $username) {

 				if($logged_in_user_obj->isFriend($username)) {
 					echo 
           '<div class="buttons">
           <button type="submit" name="remove_friend" class="danger"> Remove Friend </button>
         </div>';
 				}
 				else if ($logged_in_user_obj->didReceiveRequest($username)) {
 					echo 
           '<div class="buttons">
           <button type="submit" name="respond_request" class="warning"> Respond to Request</button>
         </div>';
 				}
 				else if ($logged_in_user_obj->didSendRequest($username)) {
          echo '<input type="submit" name="" class="default blue-btn" value="Request Sent"><br>';

 				}
       
 				else {
          echo '<div class="buttons">
                  <button type="submit" name="add_friend" class="success"> Add Friend </button>
                </div>';
        }
        

 			}

 			?>
 		</form>

     <div class="about"> <?php  
    if($userLoggedIn != $username) {
      echo '<div class="profile_info_bottom">';
        echo "<br>". $logged_in_user_obj->getMutualFriends($username) . " Mutual friends";
      echo '</div>';
    }


    ?></div>
    <div class="social-icons">
      <a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
      <a href="#" class="insta"><i class="fab fa-instagram"></i></a>
      <a href="#" class="yt"><i class="fab fa-youtube"></i></a>
    </div>
    
     <div class="social-share">
 		<div class="row">
 			<?php echo "Posts: " . $user_array['num_posts']; ?>
  </div>
  <div class="row">
  <i class="far fa-heart"></i>
        <i class="icon-2 fas fa-heart"></i>
 			<?php echo "Likes: " . $user_array['num_likes']; ?>
  </div>
       <div class="row">   
 			<span><?php echo "Friends: " . $num_friends ?></span>
 		</div>
  </div>

 	

  

 	</div>






<script>
  var userLoggedIn = '<?php echo $userLoggedIn; ?>';
  var profileUsername = '<?php echo $username; ?>';

  $(document).ready(function() {

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_profile_posts.php",
      type: "POST",
      data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area').html(data);
      }
    });

    $(window).scroll(function() {
      var height = $('.posts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area').find('.nextPage').val();
      var noMorePosts = $('.posts_area').find('.noMorePosts').val();

      if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
        $('#loading').show();

        var ajaxReq = $.ajax({
          url: "includes/handlers/ajax_load_profile_posts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
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