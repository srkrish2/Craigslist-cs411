<?php
	include_once('db_conn.php');
	$conn = connect_to_db();
	$post_id = $_POST['post_id'];
	$user = $_POST['user'];
	$query = "SELECT * FROM messages WHERE post_id = ".$post_id;
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
			echo "Chatting with: <i id='message_receiver'>".$receiver."</i><hr>";
			$flag=0;
		}
		if($user == $row['sender']) {
			echo '<div class="d-flex p-2">'.$row['sender'].' ('.$row['time_stamp'].'): '.$row['message'].'</div><hr>';
		} else {
			echo '<div class="d-flex p-2 justify-content-end">'.$row['sender'].': '.$row['message'].'</div><hr>';
		}
	}
?>
