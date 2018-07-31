<?php
	include_once('db_conn.php');
	$conn = connect_to_db();
	$text = $_POST['text'];
	$query = "SELECT * FROM posts WHERE match(city, state, make, model) against ('".$text."')";
	$result = mysqli_query($conn,$query);
	$return = '<table class="table table-dark table-bordered"';
	$return = $return.' '.'<thead><tr>
		<th scope="col">Post #</th>
		<th scope="col">Make</th>
      		<th scope="col">Model</th>
      		<th scope="col">Year</th>
		<th scope="col">Price</th>
		<th scope="col">Milage</th>
		<th scope="col">City</th>
		<th scope="col">State</th>
		<th scope="col">VIN</th>
		</tr></thead>';
	foreach($result as $row) {
		$return = $return.' '."<tr><td>".$row['post_id']."</td>
			<td id='make_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['make']."</td>
			<td id='model_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['model']."</td>
			<td id='year_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['year']."</td>
			<td id='price_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['price']."</td>
			<td id='miles_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['mileage']."</td>
			<td id='city_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['city']."</td>
			<td id='state_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['state']."</td>
			<td id='vin_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['VIN']."</td>
			<td><button type='button' onclick=redir(".$row['post_id'].") class='btn btn-success'>View</button></td></tr>";
	}
	$return = $return.' '. "</table>";
	echo $return;

?>

