<?php
	include_once('db_conn.php');
	$conn = connect_to_db();
	$query = "UPDATE posts SET make = '".$_POST['make']."', model = '".$_POST['model']."', year = ".$_POST['year'].", price = ".$_POST['price'].", mileage = ".$_POST['miles'].", city = '".$_POST['city']."', state = '".$_POST['state']."', VIN = '".$_POST['vin']."' WHERE post_id = ".$_POST['post_id'];

	if(mysqli_query($conn,$query) === TRUE) {
		echo "Post updated";
	} else {
		echo "Update failed";
	}
?>
