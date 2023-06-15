<?php
// includes/form_handlers/edit_post.php

// Retrieve the post ID and edited post content from the AJAX request
if (isset($_POST['post_id']) && isset($_POST['edited_post'])) {
  $post_id = $_POST['post_id'];
  $edited_post = $_POST['edited_post'];

  // Update the post in the database
  // Modify this code according to your database structure and update logic
  $update_query = mysqli_query($this->con, "UPDATE posts SET body='$edited_post' WHERE id='$post_id'");

  if ($update_query) {
    // Post updated successfully
    // You can add additional logic or return a success message if needed
    echo "Post updated successfully.";
  } else {
    // Failed to update post
    // You can add additional error handling or return an error message if needed
    echo "Failed to update post.";
  }
}
?>
