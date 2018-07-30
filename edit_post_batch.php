<?php
	include_once('db_conn.php');
	$conn = connect_to_db();
	mysqli_query("SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION'");
	$query = $conn->prepare("UPDATE posts SET make = ?, model = ?, year = ?, price = ?, mileage = ?, city = ?, state = ?, VIN = ? WHERE post_id = ?");
	$query->bind_param("ssiiisssi",$make,$model,$year,$price,$miles,$city,$state,$vin,$post_id);
	
	$post_ids = $_POST['post_id'];
	$makes = $_POST['make'];
	$models = $_POST['model'];
	$years = $_POST['year'];
	$prices = $_POST['price'];
	$mileses = $_POST['miles'];
	$cities = $_POST['city'];
	$states = $_POST['state'];
	$vins = $_POST['vin'];

	$i = 0;
	$conn->autocommit(FALSE);
	foreach($post_ids as $post_id) {
		$make = $makes[$i];
		$model = $models[$i];
		$year = $years[$i];
		$price = $prices[$i];
		$miles = $mileses[$i];
		$city = $cities[$i];
		$state = $states[$i];
		$vin = $vins[$i];
		if(!$query->execute()) {
			echo 'Batch update failed: '.$conn->mysqli_error();
			$conn->rollback();
			die;
		}
		$i++;
	}
	echo 'Batch update successful';
	$conn->commit();

?>

