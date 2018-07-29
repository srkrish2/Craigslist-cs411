<?php
include_once('db_conn.php');
$conn = connect_to_db();
$message = $_POST['message'];
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$post_id = $_POST['post_id'];
echo $message.$sender.$receiver.$post_id;
$query = "INSERT INTO messages (message, sender, receiver, post_id) VALUES ('".$message."','".$sender."','".$receiver."',".$post_id.")";
if(mysqli_query($conn,$query) === TRUE) {
	echo 'Message sent';
} else {
	echo 'Message failed to send'.mysqli_error($conn);
}
?>
