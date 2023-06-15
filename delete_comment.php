<?php
// delete_comment.php

require_once 'config/config.php';

if (isset($_POST['comment_id'])) {
    $commentId = $_POST['comment_id'];

    // Check if the comment exists and is posted by the user
    $checkQuery = mysqli_query($con, "SELECT * FROM post_comments WHERE id = '$commentId'");
    $comment = mysqli_fetch_array($checkQuery);
    $posted_by = $comment['posted_by'];

    if (mysqli_num_rows($checkQuery) > 0 && $posted_by == $_SESSION['username']) {
        // Delete the comment
        mysqli_query($con, "DELETE FROM post_comments WHERE id = '$commentId'");
        echo "success";
    } else {
        echo "error";
    }
}
?>
