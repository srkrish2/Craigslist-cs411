<?php
	include_once('db_conn.php');
	$conn = connect_to_db();

	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);

	$query = 'select * from posts where ';

	$nfilter = 0;
	if( $_POST['year_min'] != '' ){
		$year_min = $_POST['year_min'];
		$query = $query.' year > '.$year_min;
		$nfilter = $nfilter + 1;
	}
	if( $_POST['year_max'] != '' ){
		$year_max = $_POST['year_max'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' year < '.$year_max;
		$nfilter = $nfilter + 1;
	}
	if( $_POST['price_min'] != '' ){
		$price_min = $_POST['price_min'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' price > '.$price_min;
		$nfilter = $nfilter + 1;
	}
	if( $_POST['price_max'] != '' ){
		$price_max = $_POST['price_max'];
		if($nfilter != 0){
			$query = $query.' AND';
		}
		$query = $query.' price < '.$price_max;
		$nfilter = $nfilter + 1;
	}
	if( isset($_POST['city']) ){
		error_log("here city", 0);
		$city = $_POST['city'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		}
		$n = 0;
		foreach ($city as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' city = "'.$c.'"';
			$n = $n + 1;
		}
		$nfilter = $nfilter + 1;
		$query = $query.')';
	}
	if( isset($_POST['models']) ){
		error_log("here models",0);
		$model = $_POST['models'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		}
		$n = 0;
		foreach ($model as $c){
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' model = "'.$c.'"';
			$n = $n + 1;
		}
		$nfilter = $nfilter + 1;
		$query = $query.')';
	}
	if( isset($_POST['makes']) ){
		error_log("here makes", 0);
		$makes = $_POST['makes'];
		if($nfilter >0){
			$query = $query.' AND (';
		} else{
			$query = $query.'(';
		}
		$n = 0;
		error_log(print_r($makes, true), 0);
		$cou = count($makes);
		error_log($cou,0);
		foreach ($makes as $c){
			error_log($c,0);
			if($n != 0){
				$query = $query.' OR';
			}
			$query = $query.' make = "'.$c.'"';
			$n = $n + 1;
		}
		$nfilter = $nfilter + 1;
		$query = $query.')';
	}

	error_log($query,0);


	$result = mysqli_query($conn,$query);
	if(!$result) {
		echo $conn->error;
		die;
	}
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
			<td><button onclick=redir('".$row['post_id']."') class='btn btn-success' type='button'>View</button></td></tr>";
	}
	$return = $return.' '. "</table>";
	echo $return;

?>

