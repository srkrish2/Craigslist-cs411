<?php
	include_once('db_conn.php');
	$conn = connect_to_db();
	$post_id = $_POST['post_id'];
	$user = $_POST['user'];

	$query = 'SELECT * FROM posts WHERE post_id = '.$post_id;
	$result = mysqli_query($conn,$query);
	foreach($result as $row) {
		echo '<table class="table table-bordered table-dark">
			<tr><th>Make</th><td>'.$row['make'].'</td></tr>
			<tr><th>Model</th><td>'.$row['model'].'</td></tr>
			<tr><th>Year</th><td>'.$row['year'].'</td></tr>
			<tr><th>Mileage</th><td>'.$row['mileage'].'</td></tr>
			<tr><th>City</th><td>'.$row['city'].' ,'.$row['state'].'</td></tr>
			<tr><th>Price</th><td>$'.$row['price'].'</td></tr>
			<tr><th>Owner</th><td>'.$row['owner'].'</td></tr>
			<tr><td colspan=2><button onclick=message_user("'.$row['owner'].'") type="button" class="btn btn-success">Message</button></td></tr>
			</table>';
	}
?>

