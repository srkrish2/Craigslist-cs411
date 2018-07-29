<?php
	include_once('db_conn.php');
	session_start();
	$conn = connect_to_db();
	$user = $_POST['user'];
	$_SESSION['user'] = $user;
?>
<table id="inbox_list" class="table table-hover table-bordered">
<?php
	$query = "SELECT DISTINCT post_id FROM messages WHERE sender = '".$user."' OR receiver = '".$user."'";
	$result = mysqli_query($conn,$query);
	foreach($result as $row) {
		echo '<tr class="table-light"><td class="message" onclick=load_message('.$row['post_id'].') id="msg_'.$row['post_id'].'">Message '.$row['post_id'].'</td></tr>';
	}
?>
</table>
