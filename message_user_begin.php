<?php
include_once('db_conn.php');
$conn = connect_to_db();
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
if($receiver == '') {
	echo 'This post does not have an owner (TEST DATA ONLY)';
	die;
}
if($sender == $receiver) {
	echo 'This is your own post';
	die;
}
$post_id = $_POST['post_id'];
$message = "Hello, I am interested in this post";
$query = "INSERT INTO messages (sender,receiver,message,post_id) VALUES ('".$sender."','".$receiver."','".$message."','".$post_id."')";
if(mysqli_query($conn,$query) === TRUE) {
	echo 'Message sent to '.$receiver;
} else {
	echo 'Failed to send message';
}
?>
