<?php
	include_once('db_conn.php');
	$conn = connect_to_db();
	$post_id = $_POST['post_id'];
	$user = $_POST['user'];
	$query = "SELECT * FROM user_msgs WHERE post_id = ".$post_id." ORDER BY time_stamp DESC";
	$result = mysqli_query($conn,$query);
	$flag = 1;
	$receiver = 'placehoder';
	foreach($result as $row) {
		if($flag) {
			if($user == $row['receiver']) {
				$receiver = $row['sender'];
			} else {
				$receiver = $row['receiver'];
			}
			echo "Chatting with: <i id='message_receiver'>".$receiver."</i><br>";
			if($row['read_msg']) {
				echo '<i>Message read</i>';
			} else {
				echo '<i>Message not read</i>';
			}
			echo "<hr>";
			$flag=0;
		}
		if($user == $row['sender']) {
			echo '<div class="d-flex p-2">'.$row['sender_name'].' ('.$row['time_stamp'].'):&nbsp<b>'.$row['message'].'</b></div><hr>';
		} else {
			$query_read = "UPDATE messages SET read_msg = 1 WHERE message_id = ".$row['message_id'];
			if(mysqli_query($conn,$query_read) === FALSE) echo 'query failed';
			echo '<div class="d-flex p-2 justify-content-end">'.$row['sender_name'].' ('.$row['time_stamp'].'):&nbsp<b>'.$row['message'].'</b></div><hr>';
		}
	}
?>
