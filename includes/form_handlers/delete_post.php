<?php 
require '../../config/config.php';

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    if (isset($_POST['result']) && $_POST['result'] == 'true') {
        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($con, "UPDATE posts SET deleted='yes' WHERE id=?");
        mysqli_stmt_bind_param($stmt, "s", $post_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Check if the query was successful
        if (mysqli_affected_rows($con) > 0) {
            echo "Post deleted successfully";
        } else {
            echo "Failed to delete post";
        }
    }
}

exit();
?>
