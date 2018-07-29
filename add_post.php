<?php
	include_once('db_conn.php');
	$conn = connect_to_db();
	$query = "INSERT INTO posts (make,model,year,price,mileage,city,state,VIN,owner) VALUES('".$_POST['make']."','".$_POST['model']."',".$_POST['year'].",".$_POST['price'].",".$_POST['miles'].",'".$_POST['city']."','".$_POST['state']."','".$_POST['vin']."','shahi2')";

	echo $query;
	if(mysqli_query($conn,$query) === TRUE) {
		echo "Post added";
	} else {
		echo "Insert failed";
	}
?>
