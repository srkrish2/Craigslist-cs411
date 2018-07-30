<?php
	include_once('db_conn.php');
	$conn = connect_to_db();

	$query = 'select * from posts where '

	$nfilter = 0
	if( isset($_POST['year_min']) ){
		$year_min = $_POST['year_min'];
		$query = $query.' year > '.$year_min;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['year_max']) ){
		$year_max = $_POST['year_max'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' year < '.$year_max;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['price_min']) ){
		$price_min = $_POST['price_min'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' price > '.$price_min;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['price_max']) ){
		$price_max = $_POST['price_max'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' price < '.$price_max;
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['city']) ){
		$city = $_POST['city'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		$n = 0
		foreach ($city as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' city == "'.$c.'"';
			$n = $n + 1
		}
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['models']) ){
		$model = $_POST['models'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		$n = 0
		foreach ($model as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' model == "'.$c.'"';
			$n = $n + 1
		}
		$nfilter = $nfilter + 1
	}
	if( isset($_POST['makes']) ){
		$makes = $_POST['makes'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		$n = 0
		foreach ($makes as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' makes == "'.$c.'"';
			$n = $n + 1
		}
		$nfilter = $nfilter + 1
	}


	$result = mysqli_query($conn,$query);
	$return = '<table class="table table-dark"';
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
			<td id='vin_".$row['post_id']."' class='".$row['post_id']." editable'>".$row['VIN']."</td><td>
			</td></tr>";
	}
	$return = $return.' '. "</table>";
	echo $return;

?>

