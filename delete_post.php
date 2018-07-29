<?php
	$page = $_SERVER['PHP_SELF'];
	include_once('db_conn.php');
	$conn = connect_to_db();
	$query = "DELETE FROM posts WHERE post_id = ".$_POST['post_id'];
	if(mysqli_query($conn,$query) === TRUE) {
		echo 'Post deleted';
	} else {
		echo 'Deletion failed';
	}
	header('location: page');
?>
