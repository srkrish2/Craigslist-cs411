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
			echo $row['sender'].': '.$row['message'].'<hr>';
		} else {
			echo '<span style="float:right;">'.$row['sender'].': '.$row['message'].'</span><hr>';
		}
	}
?>
