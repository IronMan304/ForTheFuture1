<?php 
include("includes/header.php");


if(isset($_POST['post'])){

	$uploadOk = 1;
	$imageName = $_FILES['fileToUpload']['name'];
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
					<a href="#">
						<img src="images/news.png">
						Latest news
					</a>
					<a href="#">
						<img src="images/friends.png">
						Friends
					</a>
					<a href="#">
						<img src="images/group.png">
						Groups
					</a>
					<a href="#">
						<img src="images/marketplace.png">
						Marketplace
					</a>
					<a href="#">
						<img src="images/watch.png">
						Watch
					</a>
					<a href="#">
						See More
					</a>
				</div>
				<div class="shortcut-links">
					<p>Your Shortcuts</p>
					<a href="#">
						<img src="images/shortcut-1.png">
						Web Developers
					</a>
					<a href="#">
						<img src="images/shortcut-2.png">
						Web Design Course
					</a>
					<a href="#">
						<img src="images/shortcut-3.png">
						Full Stact Development
					</a>
					<a href="#">
						<img src="images/shortcut-4.png">
						Website Experts
					</a>
				</div>
			</div>


			<div class="main-content">
				

				<div class="write-post-container">
					<div class="user-profile">
						<img src="images/profile-pic.png">
						<div>
							<p><?php echo $user['first_name']; ?></p>
							<small>
								Public
								<i class="fas fa fa-caret-down"></i>
							</small>
						</div>
					</div>

					<div class="post-input-container">
						<form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<hr>

		</form>
					</div>
				</div>



				<div class="post-container">
					
					
					<div class="posts_area"></div>
		<!-- <button id="load_more">Load More Posts</button> -->
		<img id="loading" src="assets/images/icons/loading.gif">

					
					
				</div>
				
			</div>



			
			<div class="right-sidebar">
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